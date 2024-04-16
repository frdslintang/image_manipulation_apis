<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageManipulation extends Model
{
    use HasFactory;

    const TYPE_RESIZE = 'resize';
    const UPDATED_AT = false;
    protected $fillable = ['name', 'path', 'type', 'data', 'output_path', 'user_id', 'album_id'];
}
