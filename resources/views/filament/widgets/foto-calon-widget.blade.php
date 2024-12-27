<x-filament-widgets::widget>
  <x-filament::section>
    <div class="flex space-x-4" style="justify-content: space-around">
      @foreach ($this->getCalons() as $calon)
      <div class="text-center">
        <img src="{{ url('storage/' . $calon->foto) }}" alt="Foto {{ $calon->nama }}" class="w-32 h-32 object-cover rounded-full">
        <p class="mt-2 font-semibold">{{ $calon->nama }}</p>
      </div>
      @endforeach
    </div>
  </x-filament::section>
</x-filament-widgets::widget>
