<?php

namespace App\Types\Appearance;

class ThemesTypes {

    private static array $types = [ 'light', 'dark' ];

    public static function types(): array { return self::$types; }

    public static function contains(string $type): bool { return in_array($type, self::$types, true); }

}
