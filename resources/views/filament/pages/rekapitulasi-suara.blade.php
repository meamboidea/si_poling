<x-filament-panels::page>
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- FONT AWESOME MONSERRAT --}}
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }

  </style>

  <div>

    <div class="mb-1">
      <livewire:foto-calon-widget /> <!-- Memanggil widget FotoCalonWidget -->
    </div>

    <div>
      <livewire:rekapitulasi-suara-chart /> <!-- Memanggil widget RekapitulasiSuaraChart -->
    </div>
  </div>

</x-filament-panels::page>
