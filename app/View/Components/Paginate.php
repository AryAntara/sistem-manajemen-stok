<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Paginate extends Component
{
    /**
     * @var int $page_length - the length of pagination
     * @var int $page - current of page
     * @var string $route - default route
     */
    public $page_length;
    public $page;
    public $route;

    /**
     * Create a new component instance.
     * @param int $pagelength - the length of pagination
     * @param int $page - current of page
     * @param string $route - default route
     */
    public function __construct($pagelength, $page, $route)
    {
        $this->page_length = $pagelength;
        $this->page = $page;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $page = $this->page;
        $page_length = $this->page_length;
        $route = $this->route;

        return view('components.paginate', compact(
            'page',
            'page_length',
            'route'
        ));
    }
}
