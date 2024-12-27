<div class="flex space-x-4" style="justify-content: space-around">
  @foreach ($this->getCalons() as $calon)
  <div class="text-center">
    <img src="{{ url('storage/' . $calon->foto) }}" alt="Foto {{ $calon->nama }}" class="w-32 h-32 object-cover rounded-full">
    {{-- <div>

    </div> --}}
  </div>
  {{-- <div class="text-center">
    <p class="mt-2 font-semibold">{{ $calon->nama_calon_bupati }} - {{$calon->nama_calon_wakil_bupati}}</p>

</div> --}}
@endforeach
</div>
