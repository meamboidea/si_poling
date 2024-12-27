<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class RekapitulasiSuara extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.rekapitulasi-suara';

    protected static ?string $navigationLabel = 'Rekapitulasi Suara'; // Nama di sidebar
    protected static ?string $slug = 'rekapitulasi-suara';

    public function render(): View
    {
        return view(static::$view);
    }
}
