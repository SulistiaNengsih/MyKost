<!-- Modal Update Penghuni -->
<div class="modal fade" id="updatePenghuni" tabindex="-1" aria-labelledby="updatePenghuniLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('/update-penghuni')}}" method="post">
                @csrf
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahLabel">Update Data Penghuni</h1>
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
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="" placeholder="Nomor telepon penghuni..." required>
                        <div class="invalid-feedback">
                        Tolong masukkan nomor telepon penghuni.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="no_kamar" class="form-label">Nomor Kamar</label>
                        <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="" placeholder="Nomor kamar penghuni" required>
                        <div class="invalid-feedback">
                        Tolong masukkan nomor kamar.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="status" class="form-label">Status Penghuni</label>
                        <select name="status" id="status" class="form-select">
                            <option value="Terdaftar">Terdaftar</option>
                            <option value="Tidak Terdaftar">Tidak Terdaftar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" id="id" name="id" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update Data Penghuni</button>
                </div>     
            </form>
        </div>
    </div>
</div>