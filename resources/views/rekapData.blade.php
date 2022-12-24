<x-header/>
<body>
    <x-navbar halaman="rekapData"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Rekap Data Pemasukan</h3>
        </div>
            <canvas class="my-4 w-100 col" id="chartPemasukan" width="900" height="380"></canvas>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Rekap Data Pengeluaran</h3>
        </div>
            <canvas class="my-4 w-100 col" id="myChart" width="900" height="380"></canvas>
    </main>
    @php
        $jan = $pemasukan->sum('nominal as januari')->get();
        $feb = 2;    
    @endphp
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartPemasukan = document.getElementById('chartPemasukan');

        new Chart(chartPemasukan, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Rekap Pemasukan Tahun 2022',
                    data: [{{$jan->januari}}, {{$feb}}, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    borderWidth: 1
                }]
            }
        });
    </script>
<x-footer />