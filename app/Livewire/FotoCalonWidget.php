<?php

namespace App\Livewire;

use App\Models\Calon;
use Livewire\Component;

class FotoCalonWidget extends Component
{
    public function render()
    {
        return view('livewire.foto-calon-widget');
    }

    public function getCalons()
    {
        return Calon::all(); // Ambil semua data calon
    }
}
