<?php

namespace App\View\Components\Project;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class GridView extends Component
{

    private \Illuminate\Support\Collection $columns;

    public function __construct(
        public array|Collection $projects,
    )
    {
//        $this->columns = [
//            0 => collect($this->projects)->filter(function ($project, $index) { return $index % 2 == 0; }),
//            1 => collect($this->projects)->filter(function ($project, $index) { return $index % 2 == 1; })
//        ];
//        dd(collect($this->projects)->chunk(count($this->projects) / 2)->toArray());
        $this->columns = collect($this->projects)->chunk(count($this->projects) / 2);
    }

    /**
     * Get the view / contents that represent the component.
     */

    public function render(): View|Closure|string
    {
        return view('components.project.grid-view', [
            "columns" => $this->columns
        ]);
    }

}
