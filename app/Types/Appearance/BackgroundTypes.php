<?php

namespace App\Types\Appearance;

class BackgroundTypes {

    private static array $types = [
        'color-simple', 'color-gradient', 'media-image'
    ];

    public static function types(): array { return self::$types; }

    public static function contains(string $type): bool { return in_array($type, self::$types, true); }

}
