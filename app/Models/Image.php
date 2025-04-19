<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasImage;

class Image extends Model
{
    use HasFactory, HasImage;
    
    protected $fillable = ['title', 'path']; 

    protected $table = 'images';
}
