<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class update extends Component
{
    public $jenis;
    public $kategori;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($jenis, $kategori)
    {
        $this->jenis = $jenis;
        $this->kategori = $kategori;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.update');
    }
}
