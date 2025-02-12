<?php

namespace App\View\Components\Listing;

use App\Http\Resources\TaskResource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Task extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public TaskResource $task,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listing.task');
    }
}
