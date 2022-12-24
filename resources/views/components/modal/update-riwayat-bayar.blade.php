<!-- Modal Update Riwayat Bayar -->
@php
use App\Models\Penghuni;
    use App\Models\Kost;
    use App\Models\StatusPembayaran;
    use App\Models\Tahun;
    use App\Models\Bulan;
    use Illuminate\Support\Facades\Auth;

    $id_user = Auth::user()->id;
    $kost = Kost::get()->where('id_user', '=', $id_user)->first();
    $penghuni = Penghuni::where('id_kost', '=', $kost->id)->get();
@endphp

<div class="modal fade" id="updateRiwayatBayar" tabindex="-1" aria-labelledby="updateRiwayatBayarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/update-riwayat-bayar" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateRiwayatBayarLabel">Update Riwayat Pembayaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12">
                <label for="idPenghuni" class="form-label">Pilih Nama Penghuni</label>
                <select class="form-select" id="idPenghuni" name="idPenghuni" required>
                <option value="">Pilih penghuni...</option>
                    @foreach ($penghuni as $p)
                    <option value="{{$p->id}}">{{$p->nama}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Tolong pilih nama penghuni.
                </div>
            </div>
            <div class="col-12">
                <label for="idTahun" class="form-label">Pilih Tahun</label>
                <select class="form-select" name="idTahun" id="idTahun" required>
                    <option value="">Pilih tahun...</option>
                    @foreach (Tahun::get() as $tahun)
                    <option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Tolong pilih tahun.
                </div>
            </div>
            <div class="col-12">
                <label for="idBulan" class="form-label">Pilih Bulan</label>
                <select class="form-select" name="idBulan" id="idBulan" required>
                    <option value="">Pilih bulan...</option>
                    @foreach (Bulan::get() as $bulan)
                    <option value="{{$bulan->id}}">{{$bulan->bulan}}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                  Tolong pilih bulan.
                </div>
            </div>
            <div class="col-12">
                <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Pilih tanggal pembayaran..." required>
                <div class="invalid-feedback">
                  Tolong masukkan tanggal pembayaran.
                </div>
            </div>
            <div class="col-12" style="margin-top: 2%;">
                <label for="img" id="img-label" class="form-label" style="">Bukti Pembayaran</label>
                <img src="" id="img" class="img-thumbnail" style="">
            </div>
            <div class="col-12">
                <label for="fotoBuktiBayar" class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" class="form-control" id="fotoBuktiBayar" name="fotoBuktiBayar" accept="image/*">
                <div class="invalid-feedback">
                  Hanya menerima input file berupa gambar.
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id" id="id" value="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update Riwayat Pembayaran</button>
          </div>     
        </form>
      </div>
    </div>
  </div>