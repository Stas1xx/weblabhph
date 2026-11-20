<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'original_name',
        'fileable_id',
        'fileable_type',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}