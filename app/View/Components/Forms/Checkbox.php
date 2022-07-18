<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $model;
    public $judul;
    public $nilai;
    public $style;

    public function __construct($judul, $model, $nilai, $style = null)
    {
        $this->judul = $judul;
        $this->model = $model;
        $this->nilai = $nilai;
        $this->style = $style;
    }

    public function render()
    {
        return view('components.forms.checkbox');
    }
}
