<!-- Modal Hapus Riwayat Bayar -->
<div class="modal fade" id="hapusRiwayatBayar" tabindex="-1" aria-labelledby="hapusRiwayatBayarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="hapusRiwayatBayarLabel">Hapus Riwayat Pembayaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              Apakah anda yakin akan menghapus data pembayaran ini?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <form action="{{url('/hapus-riwayat-bayar')}}" method="post">
              @csrf
              <input type="hidden" value="" class="id" name="id">
              <button type="submit" class="btn btn-primary">Hapus Riwayat Pembayaran</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>