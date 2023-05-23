<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id';
    protected $fillable = ["path","filename","is_used"];
    public $timestamps = true;
}