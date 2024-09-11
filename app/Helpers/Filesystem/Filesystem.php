<?php

namespace App\Helpers\Filesystem;

/**
 * Class Filesystem
 *
 * A class providing file system-related methods.
 */
class Filesystem {

    /**
     * The directory separator used by the system.
     */
    static string $SEPARATOR = DIRECTORY_SEPARATOR;

    /**
     * Get the root directory path.
     *
     * @return string Returns the root directory path.
     */
    static function root(): string {
        return realpath(dirname(__FILE__) . FileSystem::join("/../../.."));
    }

    /**
     * Joins provided path segments into a single path string using the appropriate directory separator.
     *
     * @param string ...$paths Variable number of path segments to be joined.
     * @return string|null Returns the joined path string or null if no paths are provided.
     */
    static function join(...$paths): ?string
    {
        return preg_replace(
            '~[/\\\\]+~',
            Filesystem::$SEPARATOR,
            implode(Filesystem::$SEPARATOR, $paths)
        );
    }

}
