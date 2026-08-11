<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('main_header', 'title', 'description', 'cards', 'image', 'image_text')]
class Services extends Model
{
    protected function casts(): array
    {
        return [
            'cards' => 'array',
        ];
    }
}
