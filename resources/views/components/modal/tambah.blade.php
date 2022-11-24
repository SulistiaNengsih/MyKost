<!-- Modal Tambah -->
@php
  use App\Models\KategoriPengeluaran;
  use App\Models\KategoriPemasukan;

  $kategori;

  if ($jenis === 'Pengeluaran') {
    $kategori = KategoriPengeluaran::get();
  } else {
    $kategori = KategoriPemasukan::get();
  }
@endphp

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/store-data" method="post">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahLabel">Tambah {{$jenis}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <label for="jenis" class="form-label">Kategori {{$jenis}}</label>
            <select class="form-select" id="jenis" name="jenis" required>
              <option value="">Pilih kategori...</option>
             
              @foreach ($kategori as $kp)
              @php
                if ($jenis === 'Pengeluaran') {
                  $namaKategori = $kategori->find($kp->id)->jenis_pengeluaran;
                } else {
                  $namaKategori = $kategori->find($kp->id)->jenis_pemasukan;
                }
                
              @endphp
              <option>{{$kp->id}}-{{$namaKategori}}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">
              Tolong pilih jenis {{strtolower($jenis)}}.
            </div>
          </div>
          <div class="col-12">
            <label for="keterangan" class="form-label">Keterangan {{$jenis}}</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Bayar pajak..." required>
            <div class="invalid-feedback">
              Tolong masukkan keterangan {{strtolower($jenis)}}.
            </div>
          </div>
          <div class="col-12">
            <label for="tanggal" class="form-label">Tanggal {{$jenis}}</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Pilih tanggal..." required>
            <div class="invalid-feedback">
              Tolong masukkan tanggal {{strtolower($jenis)}}.
            </div>
          </div>
          <div class="col-12">
            <label for="nominal" class="form-label">Nominal {{$jenis}}</label>
            <input type="number" class="form-control" id="nominal" name="nominal" placeholder="32000" required>
            <div class="invalid-feedback">
              Tolong masukkan nominal {{strtolower($jenis)}}.
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <input type="hidden" id="storeJenis" name="storeJenis" value="{{strtolower($jenis)}}">
          <button type="submit" class="btn btn-primary">Tambah {{$jenis}}</button>
        </div>     
      </form>
    </div>
  </div>
</div>