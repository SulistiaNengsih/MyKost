<?php

namespace App\View\Components;

use Illuminate\View\Component;

class navbar extends Component
{
    public $halaman;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($halaman)
    {
        $this->halaman = $halaman;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
