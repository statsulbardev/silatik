<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputText extends Component
{
    public $model;
    public $judul;
    public $opsi;
    public $tipe;

    public function __construct($judul, $model, $tipe, $opsi = false)
    {
        $this->model  = $model;
        $this->judul  = $judul;
        $this->opsi   = $opsi;
        $this->tipe   = $tipe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-text');
    }
}
