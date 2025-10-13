<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tel',
        'body',
    ];

    // app/Models/Contact.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

