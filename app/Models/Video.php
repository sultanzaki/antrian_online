<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video_tables';

    protected $primaryKey = 'video_id';

    protected $fillable = ['judul', 'path_video'];
}
