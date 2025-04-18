<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory;
    use HasFactory;

    protected $table = 'admins'; // تأكد من أن الجدول مطابق لقاعدة البيانات

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


}
