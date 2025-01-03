<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',        // Add this line
        'company_description',
        'company_vision',
        'company_mission',
        'company_logo',
    ];
}
