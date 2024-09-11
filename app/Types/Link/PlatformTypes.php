<?php

namespace App\Types\Link;

class PlatformTypes {

    private static array $types = [
        'spotify', 'deezer', 'apple_music', 'soundcloud'
    ];

    public static function types(): array { return self::$types; }

    public static function contains(string $type): bool { return in_array($type, self::$types, true); }

}
