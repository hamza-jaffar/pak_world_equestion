const registerHeroSlider = () => {
    if (window.Alpine) {
        window.Alpine.data('heroSlider', (interval, total) => ({
            current: 0,
            total:   total,
            timer:   null,
            _resize: null,

            init() {
                // Force a re-render on window resize so pixel offsets stay accurate
                this._resize = () => { this.current = this.current; };
                window.addEventListener('resize', this._resize);
            },
            destroy() {
                this.stop();
                window.removeEventListener('resize', this._resize);
            },
            start() {
                this.stop();
                if (this.total <= 1) return;
                this.timer = setInterval(() => this.next(), interval);
            },
            stop() {
                clearInterval(this.timer);
                this.timer = null;
            },
            pause() { this.stop(); },
            next() {
                this.current = (this.current + 1) % this.total;
            },
            prev() {
                this.current = (this.current - 1 + this.total) % this.total;
            },
            goTo(index) {
                this.current = index;
            },
        }));
        return true;
    }
    return false;
};

if (!registerHeroSlider()) {
    document.addEventListener('alpine:init', registerHeroSlider);
}

document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const setStatus = (container, type, message) => {
        if (!container) return;

        container.className = 'rounded-md border px-4 py-3 text-sm';
        container.textContent = message;

        if (type === 'success') {
            container.classList.add('border-emerald-500', 'bg-emerald-50', 'text-emerald-700');
        } else if (type === 'error') {
            container.classList.add('border-red-500', 'bg-red-50', 'text-red-700');
        }

        container.classList.remove('hidden');
    };

    const ajaxSubmit = async (event) => {
        event.preventDefault();

        const form = event.currentTarget;
        const button = form.querySelector('[type="submit"]');
        const status = form.querySelector('[data-form-status]');
        const originalText = button?.dataset.originalText || button?.textContent || 'Submit';

        if (button) {
            button.dataset.originalText = originalText;
            button.disabled = true;
            button.textContent = button.dataset.loadingText || 'Loading...';
        }

        try {
            const response = await fetch(form.action, {
                method: form.method || 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                credentials: 'same-origin',
            });

            const data = await response.json().catch(() => null);

            if (!response.ok) {
                const message = data?.message || 'Something went wrong. Please try again.';
                throw new Error(message);
            }

            if (status) {
                setStatus(status, 'success', data?.message || 'Success!');
            }

            if (form.dataset.resetOnSuccess !== 'false') {
                form.reset();
            }
        } catch (error) {
            if (status) {
                setStatus(status, 'error', error.message || 'Something went wrong. Please try again.');
            }
        } finally {
            if (button) {
                button.disabled = false;
                button.textContent = originalText;
            }
        }
    };

    document.querySelectorAll('form[data-ajax-form]').forEach((form) => {
        form.addEventListener('submit', ajaxSubmit);
    });

    const modal = document.querySelector('[data-confirm-delete-modal]');
    if (modal) {
        const form = modal.querySelector('[data-confirm-delete-form]');
        const labelEl = modal.querySelector('[data-confirm-delete-label]');

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.dataset.open = 'false';
        };

        document.querySelectorAll('[data-delete-button]').forEach((button) => {
            button.addEventListener('click', () => {
                const route = button.dataset.deleteRoute || '';
                const label = button.dataset.deleteLabel || 'this item';

                modal.dataset.route = route;
                modal.dataset.label = label;
                if (labelEl) labelEl.textContent = label;
                if (form) form.action = route;
                modal.classList.remove('hidden');
                modal.dataset.open = 'true';
            });
        });

        document.querySelectorAll('[data-confirm-cancel-button]').forEach((button) => {
            button.addEventListener('click', closeModal);
        });

        form?.addEventListener('submit', async (event) => {
            event.preventDefault();

            const route = form.action;
            const label = modal.dataset.label || 'this item';

            if (!route) return closeModal();

            const submitButton = form.querySelector('[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Deleting...';
            }

            try {
                const formData = new FormData(form);
                formData.set('_method', 'DELETE');

                const response = await fetch(route, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    credentials: 'same-origin',
                });

                const data = await response.json().catch(() => null);

                if (!response.ok) {
                    throw new Error(data?.message || `Unable to delete ${label}.`);
                }

                const row = document.querySelector(`[data-delete-row="${route}"]`);
                if (row) {
                    row.remove();
                } else {
                    window.location.reload();
                }

                closeModal();
            } catch (error) {
                window.alert(error.message || 'Unable to delete this item.');
            } finally {
                if (submitButton) {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Delete';
                }
                closeModal();
            }
        });
    }
});
