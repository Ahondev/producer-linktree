<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected static $PLACEHOLDER_IMAGE_ID = 1;
    protected $fillable = ['name', 'source'];

    public static function createFromRequest($image, $folder=false, $name=false): Image | bool
    {
        if(!$name) { $name = time() . '.' . $image->getClientOriginalExtension(); }
        $image->storeAs('public/uploads/' . $folder ?? '', $name);
        $image = new Image([
            'name' => $name,
            'source' => '/uploads/' . ($folder ? $folder . '/' : '') . $name,
        ]);
        return $image->save() ? $image : false;
    }

    public static function getPlaceholder(): int { return self::$PLACEHOLDER_IMAGE_ID; }

}
