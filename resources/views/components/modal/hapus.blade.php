<!-- Modal Hapus -->
@php
  $text = "";
  $judul = "";

  if ($url === '/delete-data') {
    $text = "Apakah anda yakin ingin menghapus data ini?";
    $judul = "Data";
  } else {
    $text = "Apakah anda yakin ingin menghapus kategori ini? seluruh data yang berkaitan dengan kategori ini juga akan terhapus.";
    $judul = "Kategori";
  }
@endphp

<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="hapusLabel">Hapus {{$judul}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{$text}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{url(''.$url)}}" method="post">
            @csrf
            <input type="hidden" value="" class="id" name="id">
            <input type="hidden" value="{{$jenis}}" class="jenis" name="jenis">
            <button type="submit" class="btn btn-primary">Hapus {{$judul}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>