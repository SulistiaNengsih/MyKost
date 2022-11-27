<!doctype html>
<x-header/>
<body>
  <x-navbar halaman="pembukuan" />

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <div class="table-responsive">
            <table class="table table-sm">
              <tr>
                <th scope="col">
                  <h3>Kelola Kategori</h3>
                </th>
                <th scope="col" style="text-align: right">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#tambahKategori">
                    <i data-feather="plus-circle" class="text-primary" style="width:36px;height:36px;"></i>
                  </a>
                </th>
              </tr>
            </table>
          </div>
    </div>

    {{-- Tabel Pengeluaran --}}
    @if (session('statusBerhasil') !== null)
            <div class="alert alert-success alert-dismissible fade show">
              {{session('statusBerhasil')}}
              <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif
    <h4 class="h4">Kategori Pengeluaran</h4>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nomor</th>  
              <th scope="col">Id Kategori</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($kategoriPengeluaran as $kp)            
            <tr>
                <td scope="col">{{$nomor}}</td>
                <td scope="col">{{$kp->id}}</td>
                <td scope="col">{{$kp->jenis_pengeluaran}}</td>
                <td scope="col">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#editKategori" idEdit="{{$kp->id}}" jenisEdit="Pengeluaran" namaEdit="{{$kp->jenis_pengeluaran}}" id="editBtn">
                    <i data-feather="edit" class="text-primary"></i>
                  </a>
                </td>
                <td scope="col">
                  <a data-bs-toggle="modal" data-bs-target="#hapus" idHapus="{{$kp->id}}" jenis="Pengeluaran" style="color: red;" type="button" id="hapusBtn">
                    <i data-feather="trash-2" class="text-danger"></i>
                  </a>
                </td> 
            </tr>
            @php
                $nomor++;
            @endphp
            @endforeach         
          </tbody>
        </table>
      </div>

      {{-- Tabel Pemasukan --}}
      <h4 class="h4">Kategori Pemasukan</h4>
      <hr>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nomor</th>  
              <th scope="col">Id Kategori</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $nomor = 1;
            @endphp
            @foreach ($kategoriPemasukan as $kp)            
            <tr>
                <td scope="col">{{$nomor}}</td>
                <td scope="col">{{$kp->id}}</td>
                <td scope="col">{{$kp->jenis_pemasukan}}</td>
                <td scope="col">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#editKategori2" idEdit="{{$kp->id}}" jenisEdit="Pemasukan" namaEdit="{{$kp->jenis_pemasukan}}" id="editBtn">
                    <i data-feather="edit" class="text-primary"></i>
                  </a>
                </td>
                <td scope="col">
                  <a data-bs-toggle="modal" data-bs-target="#hapus" idHapus="{{$kp->id}}" jenis="Pemasukan" style="color: red;" type="button" id="hapusBtn">
                    <i data-feather="trash-2" class="text-danger"></i>
                  </a>
                </td> 
            </tr>
            @php
                $nomor++;
            @endphp
            @endforeach         
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
  </main>

  {{-- Modal --}}
  <x-modal.tambah-kategori />
  <x-modal.hapus jenis="" : url="/delete-kategori" />
  <x-modal.update-kategori jenis="Pengeluaran" />
  <x-modal.update-kategori-pemasukan />

  <script>
    // Modal Hapus
    const hapusModal = document.getElementById('hapus')
    hapusModal.addEventListener('show.bs.modal', event => {
  
    const button = event.relatedTarget
    const id = button.getAttribute('idHapus')
    const jenis = button.getAttribute('jenis')
  
    const modalId = hapusModal.querySelector('.id')
    const modalJenis = hapusModal.querySelector('.jenis')
  
    modalId.value = id
    modalJenis.value = jenis
    })
  </script>

  <script>
    // Modal Edit Pengeluaran
    const editModal = document.getElementById('editKategori')
    editModal.addEventListener('show.bs.modal', event => {
  
    const buttonEdit = event.relatedTarget
    const idEdit = buttonEdit.getAttribute('idEdit')
    const jenisEdit = buttonEdit.getAttribute('jenisEdit')
    const namaEdit = buttonEdit.getAttribute('namaEdit')
  
    const modalIdEdit = editModal.querySelector('.idUpdate')
    const modalJenisEdit = editModal.querySelector('.jenisUpdate')
    const modalNamaEdit = editModal.querySelector('.nama')
  
    modalIdEdit.value = idEdit
    modalJenisEdit.value = jenisEdit
    modalNamaEdit.value = namaEdit
    })
  </script>

<script>
  // Modal Edit Pemasukan
  const editPemasukan = document.getElementById('editKategori2')
  editPemasukan.addEventListener('show.bs.modal', event => {

  const buttonEdit = event.relatedTarget
  const idEdit = buttonEdit.getAttribute('idEdit')
  const jenisEdit = buttonEdit.getAttribute('jenisEdit')
  const namaEdit = buttonEdit.getAttribute('namaEdit')

  const modalIdEdit = editPemasukan.querySelector('.idUpdate')
  const modalJenisEdit = editPemasukan.querySelector('.jenisUpdate')
  const modalNamaEdit = editPemasukan.querySelector('.nama')

  modalIdEdit.value = idEdit
  modalJenisEdit.value = jenisEdit
  modalNamaEdit.value = namaEdit
  })
</script>

    
<x-footer />