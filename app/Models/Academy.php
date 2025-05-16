<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;
    protected $appends = ['media_path_url'];
    protected $fillable = [
        'title',
        'description',
        'media_type',
        'media_path',
    ];
    public function getMediaPathUrlAttribute()
{
    return asset('storage/' . $this->media_path);
}

}
