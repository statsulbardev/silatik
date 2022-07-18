<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $judul;
    public $model;
    public $opsi;

    public function __construct($judul = null, $model, $opsi)
    {
        $this->judul = $judul;
        $this->model = $model;
        $this->opsi  = $opsi;
    }

    public function render()
    {
        return view('components.forms.select');
    }
}
