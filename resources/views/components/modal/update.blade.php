<!-- Edit Pengeluaran -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editLabel">Edit {{$jenis}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{url('/update-data')}}" method="post">
                @csrf
                <div class="col-12">
                  <label for="jenis" class="form-label">Kategori {{$jenis}}</label>
                  <select class="form-select" id="jenis" name="jenis" value="" required>
                    <option>Pilih kategori {{$jenis}}...</option>
                    @foreach (DB::table('kategori_pengeluaran')->get() as $kp)
                        @if ($jenis === 'Pengeluaran')
                            <option>{{$kp->id}}-{{$kp->jenis_pengeluaran}}</option>
                        @else 
                            <option>{{$kp->id}}-{{$kp->jenis_pemasukan}}</option>
                        @endif
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Tolong pilih kategori {{strtolower($jenis)}}.
                  </div>
                </div>
                <div class="col-12">
                  <label for="keterangan" class="form-label">Keterangan {{$jenis}}</label>
                  <input type="text" class="form-control" id="keterangan" name="keterangan" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan keterangan {{$jenis}}.
                  </div>
                </div>
                <div class="col-12">
                  <label for="tanggal" class="form-label">Tanggal {{$jenis}}</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan tanggal {{$jenis}}.
                  </div>
                </div>
                <div class="col-12">
                  <label for="nominal" class="form-label">Nominal {{$jenis}}</label>
                  <input type="number" class="form-control" id="nominal" name="nominal" value="" required>
                  <div class="invalid-feedback">
                    Tolong masukkan nominal {{$jenis}}.
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