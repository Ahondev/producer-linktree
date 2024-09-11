<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'image_id'];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
