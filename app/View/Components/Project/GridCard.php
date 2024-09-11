<?php

namespace App\View\Components\Project;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GridCard extends Component
{

    public function __construct(
        public Project $project,
        public int $index
    ) { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project.grid-card');
    }
}
