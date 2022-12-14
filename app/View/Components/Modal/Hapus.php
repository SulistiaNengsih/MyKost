<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class Hapus extends Component
{
    public $jenis;
    public $url;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($jenis, $url)
    {
        $this->jenis = $jenis;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.hapus');
    }
}
