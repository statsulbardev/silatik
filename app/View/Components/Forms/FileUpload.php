<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class FileUpload extends Component
{
    public $model;
    public $judul;
    public $opsi;

    public function __construct($judul, $model, $opsi = null)
    {
        $this->judul = $judul;
        $this->model = $model;
        $this->opsi  = $opsi;
    }

    public function render()
    {
        return view('components.forms.file-upload');
    }
}
