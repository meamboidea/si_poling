<?php

namespace App\Filament\Widgets;

use App\Models\Tps;
use App\Models\Calon;
use App\Models\Suara;
use Filament\Widgets\ChartWidget;

class RekapitulasiSuaraChart extends ChartWidget
{
    protected static ?string $heading = 'Rekapitulasi Suara';

    // Mengatur lebar widget menjadi full width
    public function getColumnSpan(): string|int
    {
        return 'full'; // Mengatur widget agar lebar penuh
    }

    protected function getData(): array
    {
        // Mendapatkan data perolehan suara Calon A (calon_id = 1)
        $suaraCalonA = Suara::where('calon_id', 1)
            // ->selectRaw('sum(jumlah_suara) as total, tps_id')
            // ->groupBy('tps_id')
            // ->pluck('total', 'tps_id');
            // ->pluck('total');
            ->sum('jumlah_suara');

        // Mendapatkan data perolehan suara Calon B (calon_id = 2)
        $suaraCalonB = Suara::where('calon_id', 2)
            // ->selectRaw('sum(jumlah_suara) as total, tps_id')
            // ->groupBy('tps_id')
            // ->pluck('total');
            ->sum('jumlah_suara');

        // Mengambil nama TPS berdasarkan id
        // $labels = Tps::whereIn('id', $suaraCalonA->keys())->pluck('nama_tps')->toArray();
        $labels = ['Total Suara '];

        // Ambil URL foto dari calon
        $calonA = Calon::find(1); // Calon A
        $calonB = Calon::find(2); // Calon B
        $fotoCalonA = url('storage/' . $calonA->foto); // Path foto Calon A
        $fotoCalonB = url('storage/' . $calonB->foto); // Path foto Calon B

        return [
            'datasets' => [
                [
                    'label' => 'BERAMAL',
                    'data' => [$suaraCalonA],
                    // 'data' => $suaraCalonA->values(), // Data suara untuk Calon A
                    'borderColor' => 'rgba(146, 194, 253, 1)', // Warna garis Calon A
                    'backgroundColor' => 'rgba(146, 194, 253, 1)', // Warna area di bawah garis Calon A
                    'pointStyle' => 'image',
                    'pointRadius' => 10,
                    'pointBackgroundImage' => 'https://cdn-icons-png.flaticon.com/512/1828/1828665.png',
                ],
                [
                    'label' => 'JADI',
                    // 'data' => $suaraCalonB->values(), // Data suara untuk Calon B
                    'data' => [$suaraCalonB],
                    'borderColor' => 'rgba(217, 5, 5, 1)', // Warna garis Calon B
                    'backgroundColor' => 'rgba(217, 5, 5, 1)', // Warna area di bawah garis Calon B

                ],
            ],
            'labels' => $labels, // Nama TPS yang akan ditampilkan di sumbu X
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => function ($tooltipItem) {
                            $calon = $tooltipItem['datasetIndex'] === 0 ? Calon::find(1) : Calon::find(2);
                            $fotoCalon = url('storage/' . $calon->foto);

                            return "<img src='{$fotoCalon}' style='width:50px;height:50px;' /> " . $calon->nama;
                        },
                    ],
                ],
            ],
        ];
    }
}
