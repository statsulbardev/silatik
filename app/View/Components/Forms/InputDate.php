<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputDate extends Component
{
    public $model;
    public $judul;
    public $opsi;

    public function __construct($judul, $model, $opsi = null)
    {
        $this->model = $model;
        $this->judul = $judul;
        $this->opsi  = $opsi;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-date');
    }
}
