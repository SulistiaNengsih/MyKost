<!-- Edit Kost -->
<div class="modal fade" id="editKost" tabindex="-1" aria-labelledby="editKostLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editKostLabel">Edit Data Kost</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/update-kost')}}" method="post">
                @csrf
                <div class="col-12">
                  <label for="nama" class="form-label">Nama Kost</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan nama kost.
                  </div>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat Kost</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="" required>
                    <div class="invalid-feedback">
                      Tolong masukkan alamat kost.
                    </div>
                </div>
                <div class="col-12">
                    <label for="sewa" class="form-label">Biaya Sewa Bulanan</label>
                    <input type="number" class="form-control" id="sewa" name="sewa" value="" required>
                    <div class="invalid-feedback">
                      Tolong masukkan biaya sewa bulanan.
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <input type="hidden" id="id" name="id" class="id" value="1">
            <button type="submit" class="btn btn-primary">Edit Data Kost</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>