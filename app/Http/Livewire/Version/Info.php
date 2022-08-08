<?php

namespace App\Http\Livewire\Version;

use Livewire\Component;

class Info extends Component
{
    public function render()
    {
        return view('livewire.version.info', [
            'commit'    => config('version.commit'),
            'tag'       => config('version.tag'),
            'branch'    => config('version.branch'),
            'deskripsi' => config('version.deskripsi')
        ])->layout('layouts.main');
    }
}
