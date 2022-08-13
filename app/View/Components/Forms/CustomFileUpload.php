<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class CustomFileUpload extends Component
{
    public string $judul;
    public $model;

    public function __construct(string $judul, $model)
    {
        $this->judul = $judul;
        $this->model = $model;
    }

    public function render()
    {
        return view('components.forms.custom-file-upload');
    }
}
