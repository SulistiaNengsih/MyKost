<!doctype html>
<x-header/>
<body>
  <x-navbar halaman="pembukuan" />

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h3">Edit data {{$jenis}}</h3>
    </div>

    @php
      use App\Models\KategoriPengeluaran;
      use App\Models\KategoriPemasukan;

      $url = '';
      $urlBack = '';
      $keterangan = '';
      $tanggal = '';
      $nominal = '';
      $kategori;

      if ($jenis === 'pengeluaran') {
        $url = '/update-pengeluaran';
        $urlBack = '/pembukuan-pengeluaran';
        $keterangan = $pengeluaran->ket_pengeluaran;
        $tanggal = $pengeluaran->tanggal;
        $nominal = $pengeluaran->nominal;
        $kategori = KategoriPengeluaran::get();
      } else {
        $url = '/update-pemasukan';
        $urlBack = '/pembukuan-pemasukan';
        $keterangan = $pemasukan->ket_pemasukan;
        $tanggal = $pemasukan->tanggal;
        $nominal = $pemasukan->nominal;
        $kategori = KategoriPemasukan::get();
      } 
    @endphp
      
    <form action="{{url(''.$url)}}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{$id}}">
        <div class="col-12">
          <label for="jenis" class="form-label">Kategori {{$jenis}}</label>
          <select class="form-select" id="jenis" name="jenis" required>
            <option value="">Pilih kategori {{$jenis}}...</option>
              @foreach ($kategori as $kp)
                <option>{{$kp->id}}-{{$kp->jenis_pengeluaran}}</option>
              @endforeach
          </select>
          <div class="invalid-feedback">
            Tolong pilih kategori pengeluaran.
          </div>
        </div>
        <div class="col-12">
          <label for="keterangan" class="form-label">Keterangan {{$jenis}}</label>
          <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$keterangan}}" required>
          <div class="invalid-feedback">
            Tolong masukkan keterangan {{$jenis}}.
          </div>
        </div>
        <div class="col-12">
          <label for="tanggal" class="form-label">Tanggal {{$jenis}}</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$tanggal}}" required>
          <div class="invalid-feedback">
            Tolong masukkan tanggal {{$jenis}}.
          </div>
        </div>
        <div class="col-12">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="number" class="form-control" id="nominal" name="nominal" value="{{$nominal}}" required>
          <div class="invalid-feedback">
            Tolong masukkan nominal {{$jenis}}.
          </div>
        </div>
        <div class = "col-12" style="margin-top: 2%;">
          <a type="button" class="btn btn-secondary" href="{{url('').$urlBack}}">Batal</a>
          <button type="submit" class="btn btn-primary">Edit {{$jenis}}</button>
        </div>
    </form>
  </main>

<x-footer />