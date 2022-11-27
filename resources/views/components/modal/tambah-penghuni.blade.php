<!-- Modal Tambah Penghuni -->
<div class="modal fade" id="tambahPenghuni" tabindex="-1" aria-labelledby="tambahPenghuniLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('/tambah-penghuni')}}" method="post">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahLabel">Tambah Penghuni</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama penghuni..." required>
                        <div class="invalid-feedback">
                        Tolong masukkan nama penghuni.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="tanggal" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Nomor telepon penghuni..." required>
                        <div class="invalid-feedback">
                        Tolong masukkan nomor telepon penghuni.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="no_kamar" class="form-label">Nomor Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" name="no_kamar" placeholder="Nomor kamar penghuni" required>
                        <div class="invalid-feedback">
                        Tolong masukkan nomor kamar.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <input type="hidden" id="status" name="status" value="Terdaftar">
                <button type="submit" class="btn btn-primary">Tambah Penghuni</button>
                </div>     
            </form>
        </div>
    </div>
</div>