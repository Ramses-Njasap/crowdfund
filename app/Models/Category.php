<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // The table associated with the model.
    protected $table = 'categories';

    // The attributes that are mass assignable.
    protected $fillable = ['name'];
}

