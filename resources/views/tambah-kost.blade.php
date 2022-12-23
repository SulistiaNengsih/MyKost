<x-header/>
<body>
    <x-navbar halaman="penghuni"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap border-bottom flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h2 class="h2">Tambah Kost</h2>
        </div>

        <h6 class="h6">Anda belum menambahkan kost</h6>

        <form action="{{url('/tambah-kost')}}" method="post">
            @csrf
            <div class="col-12" style="margin:2%;">
              <label for="nama" class="form-label">Nama Kost</label>
              <input type="text" class="form-control" id="nama" name="nama" value="" required>
              <div class="invalid-feedback">
                Tolong masukkan nama kost.
              </div>
            </div>
            <div class="col-12" style="margin:2%;">
                <label for="alamat" class="form-label">Alamat Kost</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="" required>
                <div class="invalid-feedback">
                  Tolong masukkan alamat kost.
                </div>
            </div>
            <div class="col-12" style="margin:2%;">
                <label for="sewa" class="form-label">Biaya Sewa Bulanan</label>
                <input type="number" class="form-control" id="sewa" name="sewa" value="" required>
                <div class="invalid-feedback">
                  Tolong masukkan biaya sewa bulanan.
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin:5px;">Batal</button>
        <button type="submit" class="btn btn-primary" style="margin:5px">Tambah Data Kost</button>
        </div>
        </form>  
<x-footer />

