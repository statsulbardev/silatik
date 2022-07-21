<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class MultiSelect extends Component
{
    public $judul;
    public $model;
    public $opsi;
    public $placeholder;

    public function __construct($judul, $model, $opsi, $placeholder)
    {
        $this->judul = $judul;
        $this->model = $model;
        $this->opsi  = $opsi;
        $this->placeholder = $placeholder;
    }

    public function render()
    {
        return view('components.forms.multi-select');
    }
}
