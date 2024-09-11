<?php

namespace App\View\Components\Testimonial;

use App\Models\Review;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonial extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Review $testimonial,
        public int $index,
    )
    { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial.testimonial');
    }
}
