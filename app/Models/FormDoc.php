<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code_name',
        'field_requests',
        'body',
    ];
}
