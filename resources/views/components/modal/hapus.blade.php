<!-- Modal Hapus -->
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="hapusLabel">Hapus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{url('/delete-data')}}" method="post">
            @csrf
            <input type="hidden" value="" class="id" name="id">
            <input type="hidden" value="{{$jenis}}" class="jenis" name="jenis">
            <button type="submit" class="btn btn-primary">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>