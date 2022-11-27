<!-- Modal Hapus Penghuni -->
<div class="modal fade" id="hapusPenghuni" tabindex="-1" aria-labelledby="hapusPenghuniLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="hapusPenghuniLabel">Hapus Penghuni</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Apakah anda yakin akan menghapus penghuni ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{url('/hapus-penghuni')}}" method="post">
            @csrf
            <input type="hidden" value="" class="id" name="id">
            <input type="hidden" value="" class="nama" name="nama">
            <button type="submit" class="btn btn-primary">Hapus Penghuni</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>