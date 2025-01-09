<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $table = 'testimonials';
    use HasFactory;

    protected $fillable = [
        'client_name',        // Add this line
        'client_email',
        'client_photo',
        'testimonial',
        'is_approved',
    ];
}
