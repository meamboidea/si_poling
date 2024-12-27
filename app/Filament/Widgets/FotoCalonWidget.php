<?php

namespace App\Filament\Widgets;

use App\Models\Calon;
use Filament\Widgets\Widget;

class FotoCalonWidget extends Widget
{
    protected static string $view = 'filament.widgets.foto-calon-widget';

    // Mengatur lebar widget menjadi full width
    public function getColumnSpan(): string|int
    {
        return 'full'; // Mengatur widget agar lebar penuh
    }

    public function getCalons()
    {
        return Calon::all(); // Ambil semua data calon
    }
}
