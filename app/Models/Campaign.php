<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'page_id'];

    protected static function booted(): void
    {
        static::creating(function ($campaign) {
            $page = Page::factory()->create();
            $campaign->page_id = $page->id;

            $appearance = Appearance::factory()->create();
            $campaign->appearance_id = $appearance->id;
        });
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function appearance()
    {
        return $this->belongsTo(Appearance::class);
    }

}
