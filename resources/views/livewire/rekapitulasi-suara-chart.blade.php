<div wire:poll.5s>
  {{-- @dd($data) --}}
  {{-- {!!json_encode($data)!!} --}}
  <div wire:ignore>
    <canvas id="rekapitulasiSuaraChart" style="max-height: 500px !important"></canvas>


  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <script>
    let rekapitulasiSuaraChart = null;

    document.addEventListener('livewire:init', function() {



      // Fungsi untuk membuat atau memperbarui chart
      function renderChart(labels, data, colors) {
        const ctx = document.getElementById('rekapitulasiSuaraChart').getContext('2d');

        if (!labels || !data || !colors || labels.length === 0 || data.length === 0 || colors.length === 0) {
          console.error("Data chart tidak valid:", {
            labels
            , data
            , colors
          });
          return;
        }

        if (rekapitulasiSuaraChart) {
          rekapitulasiSuaraChart.data.labels = labels;
          rekapitulasiSuaraChart.data.datasets[0].data = data;
          rekapitulasiSuaraChart.data.datasets[0].backgroundColor = colors.slice(0, data.length);
          rekapitulasiSuaraChart.data.datasets[0].borderColor = colors.slice(0, data.length).map(color => color.replace('1)', '0.8'));
          rekapitulasiSuaraChart.update();


        } else {

          // Jika chart belum ada, buat chart baru
          rekapitulasiSuaraChart = new Chart(ctx, {
            type: 'bar'
            , data: {
              labels: labels
              , datasets: [{
                label: 'Jumlah Suara'
                , data: data
                , backgroundColor: colors.slice(0, data.length)
                , borderColor: colors.slice(0, data.length).map(color => color.replace('1)', '0.8'))
                , borderWidth: 1
              }]
            }
            , options: {
              plugins: {
                legend: {
                  labels: {
                    font: {
                      family: "'Montserrat', cursive, sans-serif", // Custom font family
                      size: 12, // Custom font size
                      //   style: 'italic', // Custom font style
                      weight: 'bold' // Custom font weight
                    }
                  }
                }
                , tooltip: {
                  titleFont: {
                    family: "'Montserrat', monospace", // Custom font family for tooltip title
                    size: 14
                  }
                  , bodyFont: {
                    family: "'Montserrat', sans-serif", // Custom font family for tooltip body
                    size: 12
                  }
                }
              },

              responsive: true
              , scales: {
                y: {
                  ticks: {
                    font: {
                      family: "'Montserrat', sans-serif", // Custom font for x-axis
                      size: 12
                      , weight: 'bold'
                    }
                  }
                  , beginAtZero: true
                  , title: {
                    display: true
                    , text: 'Jumlah Suara'
                    , font: {
                      family: "'Montserrat', sans-serif", // Custom font for x-axis
                      size: 12
                      , weight: 'bold'
                    }
                  }
                }
                , x: {
                  ticks: {
                    font: {
                      family: "'Montserrat', sans-serif", // Custom font for x-axis
                      size: 12
                      , weight: 'bold'
                    }
                  }
                  , title: {
                    display: true
                    , text: 'Calon'
                    , font: {
                      family: "'Montserrat', sans-serif", // Custom font for x-axis
                      size: 14
                      , weight: 'bold'
                    }
                  }
                }
              }
            }
          });
        }
      }

      // Mendengarkan event Livewire untuk update data chart
      Livewire.on('chartUpdated', function(response) {
        if (!Array.isArray(response) || response.length === 0) {
          console.error("Response tidak valid:", response);
          return;
        }

        const dataObject = response[0]; // Ambil objek pertama dari array
        const labels = dataObject.labels;
        const chartData = dataObject.data.map(Number); // Pastikan data numerik
        const colors = dataObject.colors;

        console.log("Data chart diterima dari Livewire:", dataObject);

        if (!labels || !chartData || !colors || labels.length === 0 || chartData.length === 0 || colors.length === 0) {
          console.error("Data chart tidak valid:", {
            labels
            , chartData
            , colors
          });
          return;
        }

        renderChart(labels, chartData, colors);


      });

      // Inisialisasi pertama kali dengan data awal
      const initialLabels = @json($labels);
      const initialData = @json($data);
      const initialColors = @json($colors);

      console.log(initialLabels, initialData, initialColors);

      renderChart(initialLabels, initialData, initialColors);


    });

  </script>

  <div class="marquee-container">
    <div class="marquee">
      @foreach($dataBaru as $suara)
      <span>No : {{ $suara->calon_id }}. {{$suara->nama_calon_bupati}}-{{$suara->nama_calon_wakil_bupati}}, Jumlah Suara: {{ $suara->jumlah_suara }}. TPS : {{$suara->nama_tps}} Desa : {{$suara->nama_desa}} Kec. : {{$suara->nama_kecamatan}}</span>
      @endforeach
    </div>
  </div>

  <style>
    .marquee-container {
      overflow: hidden;
      white-space: nowrap;
      box-sizing: border-box;
      width: 100%;
      /* Atur lebar sesuai kebutuhan */
      border: 1px solid #ccc;
      /* Opsional: menambahkan batas */
      padding: 10px;
      /* Opsional: menambahkan padding */
      background-color: #f9f9f9;
      /* Opsional: latar belakang */
    }

    .marquee {
      display: inline-block;
      animation: marquee 60s linear infinite;
      /* Durasi animasi bisa disesuaikan */
    }

    @keyframes marquee {
      0% {
        transform: translate(100%, 0);
      }

      100% {
        transform: translate(-100%, 0);
      }
    }

  </style>



</div>
