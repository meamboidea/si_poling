<?php

namespace App\Livewire;

use App\Models\Calon;
use App\Models\Suara;
use Livewire\Component;

class RekapitulasiSuaraChart extends Component
{
    public $labels = [];
    public $data = [];
    public $colors = [];

    public $dataBaru = [];



    public function render()
    {
        // $this->updateChartData();
        //Ambil data perolehan suara dari database
        $perolehanSuara = Suara::select('calon_id', \DB::raw('SUM(jumlah_suara) as total_suara'))
            ->groupBy('calon_id')
            ->get();

        $this->dataBaru = Suara::join('calons', 'calons.id', '=', 'suaras.calon_id')
            ->join('tps', 'tps.id', '=', 'suaras.tps_id')
            ->join('kecamatans', 'kecamatans.id', '=', 'tps.kecamatan_id')
            ->join('desas', 'desas.id', '=', 'tps.desa_id')
            ->select('calons.nama_calon_bupati', 'calons.nama_calon_wakil_bupati', 'tps.nama_tps', 'kecamatans.nama_kecamatan', 'desas.nama_desa')
            ->orderBy('suaras.created_at', 'desc')->take(5)->get();
        // dd($perolehanSuara->toArray());

        $calonA =Calon::find(1);
        $calonB =Calon::find(2);

        $pasanganCalonA = $calonA->nama_calon_bupati . ' - ' . $calonA->nama_calon_wakil_bupati;
        $pasanganCalonB = $calonB->nama_calon_bupati . ' - ' . $calonB->nama_calon_wakil_bupati;
        // Mengonversi ke array
        // $labels = $perolehanSuara->pluck('calon_id')->toArray();
        $this->labels = [
            $pasanganCalonA,
            $pasanganCalonB,
            // Tambahkan label lain jika ada calon tambahan
        ];
        $this->data = $perolehanSuara->pluck('total_suara')->toArray();

        // Menentukan warna untuk masing-masing calon
        $this->colors = [
            'rgba(146, 194, 253, 1)', // Warna untuk calon A
            'rgba(217, 5, 5, 1)', // Warna untuk calon B
            // Tambahkan warna lain jika ada calon tambahan
        ];

        $this->dispatch('chartUpdated', [
            'labels' => $this->labels,
            'data' => $this->data,
            'colors' => $this->colors,
        ]);

        return view('livewire.rekapitulasi-suara-chart');
    }
}
