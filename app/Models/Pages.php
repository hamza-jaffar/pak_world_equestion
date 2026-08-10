<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('slug', 'name', 'content', 'meta_title', 'meta_description', 'is_active')]
class Pages extends Model
{
    //
}
