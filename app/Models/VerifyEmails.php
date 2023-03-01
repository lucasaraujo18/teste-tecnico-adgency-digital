<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyEmails extends Model
{
    use HasFactory;

    protected $table = 'verify_emails';

    protected $fillable = [
        'email',
        'verify_code',
        'status'
    ];
}
