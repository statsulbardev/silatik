<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $model;
    public $judul;
    public $opsi;
    public $ukuran;

    public function __construct($judul, $model, $opsi = null, $ukuran = null)
    {
        $this->model  = $model;
        $this->judul  = $judul;
        $this->opsi   = $opsi;
        $this->ukuran = $ukuran;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.text-area');
    }
}
