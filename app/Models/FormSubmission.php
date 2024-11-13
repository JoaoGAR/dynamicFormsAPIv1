<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;
    protected $table = 'form_submissions';

    protected $fillable = [
        'form_id',
        'fields'
    ];

    protected $casts = [
        'fields' => 'array',
    ];
}
