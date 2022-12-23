<x-header/>
<body>
    <x-navbar halaman="kost"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap border-bottom flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h2 class="h2">Data Kost</h2>
        </div>

        @php
            function formatRupiah($angka) {
            $hasil = "Rp " . number_format($angka,2,',','.');
            return $hasil;
            }
        @endphp

        @if (session('statusBerhasil') !== null)
        <div class="alert alert-success alert-dismissible fade show">
        {{session('statusBerhasil')}}
        <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{$kost->nama}}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Biaya sewa bulanan {{formatRupiah($kost->find(1)->biaya_sewa_bulanan)}}</h6>
              <p class="card-text">{{$kost->alamat}}</p>
              <p class="card-text"><small class="text-muted">Jumlah penghuni: {{$penghuni->count()}}</small></p>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKost" style="float: right;">Edit Data Kost</button>
    </main>

    <x-modal.update-kost />
<x-footer />