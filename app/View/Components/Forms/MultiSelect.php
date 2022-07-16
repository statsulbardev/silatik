<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class MultiSelect extends Component
{
    public $judul;
    public $model;
    public $opsi;

    public function __construct($judul, $model, $opsi)
    {
        $this->judul = $judul;
        $this->model = $model;
        $this->opsi  = $opsi;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.multi-select');
    }
}
