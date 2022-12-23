<!-- Edit Pengeluaran -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editLabel">Edit {{$jenis}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/update-data')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                  <label for="jenis" class="form-label">Kategori {{$jenis}}</label>
                  <select class="form-select" id="jenis" name="jenis" value="" required>
                    <option>Pilih kategori {{$jenis}}...</option>
                    @if ($jenis === 'Pengeluaran')
                      @foreach (DB::table('kategori_pengeluaran')->get() as $kp)
                        <option>{{$kp->id}}-{{$kp->jenis_pengeluaran}}</option>
                      @endforeach
                    @else
                      @foreach (DB::table('kategori_pemasukan')->get() as $kp)
                        <option>{{$kp->id}}-{{$kp->jenis_pemasukan}}</option>
                      @endforeach
                    @endif                    
                  </select>
                  <div class="invalid-feedback">
                    Tolong pilih kategori {{strtolower($jenis)}}.
                  </div>
                </div>
                <div class="col-12" style="margin-top: 2%;">
                  <label for="keterangan" class="form-label">Keterangan {{$jenis}}</label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan keterangan {{$jenis}}.
                  </div>
                </div>
                <div class="col-12" style="margin-top: 2%;">
                  <label for="tanggal" class="form-label">Tanggal {{$jenis}}</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan tanggal {{$jenis}}.
                  </div>
                </div>
                <div class="col-12" style="margin-top: 2%;">
                  <label for="nominal" class="form-label">Nominal {{$jenis}}</label>
                  <input type="number" class="form-control" id="nominal" name="nominal" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan nominal {{$jenis}}.
                  </div>
                </div>
                <div class="col-12" style="margin-top: 2%;">
                  <label for="img" id="img-label" class="form-label" style="">Bukti {{$jenis}}</label>
                  <img src="" id="img" class="img-thumbnail" style="">
                </div>
                <div class="col-12" style="margin-top: 2%;">
                  <label for="foto" class="form-label">Upload Bukti {{$jenis}}</label>
                  <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                  <div class="invalid-feedback">
                    Hanya menerima input file berupa gambar.
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <input type="hidden" id="jenisUpdate" name="jenisUpdate" value="{{$jenis}}">
            <input type="hidden" id="idUpdate" name="idUpdate" class="idUpdate" value="">
            <button type="submit" class="btn btn-primary">Edit {{$jenis}}</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>