<?php

namespace App\View\Components;

use App\Helpers\Filesystem\Filesystem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{

    public static bool $VITE_DEV_CHECK = false;
    public static bool $VITE_DEV_RUNNING = false;

    private static function check_vite_state(): void
    {
        $hot = Filesystem::join(Filesystem::root(), "public", "hot");
        if (is_file($hot)) { self::$VITE_DEV_RUNNING = true; }
        self::$VITE_DEV_CHECK = true;
    }

    public function __construct(
        public string $name,
        public string $alt,
        public string|bool $class = false
    ) { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!Image::$VITE_DEV_CHECK) { Image::check_vite_state(); }
        return view('components.image')->with(
            ["vite" => Image::$VITE_DEV_RUNNING ? "dev" : "build"]
        );
    }
}
