<x-header/>
<body>
  <x-navbar halaman="pembukuan"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pembukuan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href = "{{url('/pembukuan-pengeluaran')}}" class="btn btn-sm btn-secondary">Pengeluaran</a>
            <a href="{{url('/pembukuan-pemasukan')}}" class= "btn btn-sm btn-outline-secondary">Pemasukan</a>
          </div>

          <div class="dropdown">
            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if (empty($filter))
                Semua Kategori
              @else
                {{$filter}}
              @endif
            </button>
            <ul class="dropdown-menu">
              @if (isset($filter))
                <li class="dropdown-item">
                  <a class="dropdown-item" href="{{url('/pembukuan-pengeluaran')}}">Semua Kategori</a>
                </li>
              @endif
              <li class = "dropdown-item"><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tambahKategori">Tambah Kategori</a></li>
              <li class = "dropdown-item"><a class="dropdown-item" href="{{url('/kelola-kategori')}}">Kelola Kategori</a></li>
              <hr>
              @foreach ($kategoriPengeluaran as $kp)
              <li class = "dropdown-item">
                <a class = "dropdown-item" href="{{url('/pembukuan-pengeluaran?filter='.$kp->jenis_pengeluaran)}}">{{$kp->jenis_pengeluaran}}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <canvas class="my-4 w-100 col" id="myChart" width="900" height="380"></canvas>

      <div class="table-responsive">
        <table class="table table-sm">
          <tr>
            <th scope="col">
              <h3>Pengeluaran</h3>
            </th>
            <th scope="col" style="text-align: right">
              <a type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#tambah" style="margin-top: 1%; margin-bottom:1%;">
                Tambah Pengeluaran
              </a>
            </th>
          </tr>
        </table>
      </div>
      
      <div class="table-responsive">
        @if (session('statusBerhasil') !== null)
        <div class="alert alert-success alert-dismissible fade show">
          {{session('statusBerhasil')}}
          <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nomor</th>  
              <th scope="col">Kategori</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Nominal</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php
                function formatRupiah($angka) {
                  $hasil = "Rp " . number_format($angka,2,',','.');
                  return $hasil;
                }
                $nomor = 1;
                $id = 0;
            @endphp
            @foreach ($pengeluaran as $p)            
            <tr>
                <td scope="col">{{$nomor}}</td>
                <td scope="col">{{$p->jenis_pengeluaran}}</td>
                <td scope="col">{{$p->ket_pengeluaran}}</td>
                <td scope="col">{{$p->tanggal}}</td>
                <td scope="col">{{formatRupiah($p->nominal)}}</td>
                <td scope="col">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#edit" idEdit="{{$p->id}}" nominal="{{$p->nominal}}" tanggal="{{$p->tanggal}}" ket="{{$p->ket_pengeluaran}}" idKategori="{{$p->id_kategori_pengeluaran}}" kategori="{{$p->jenis_pengeluaran}}"  id="editBtn">
                    <i data-feather="edit" class="text-primary"></i>
                  </a>
                </td>
                <td scope="col">
                  <a data-bs-toggle="modal" data-bs-target="#hapus" data-bs-idHapus="{{$p->id}}" style="color: red;" type="button" id="hapusBtn">
                    <i data-feather="trash-2" class="text-danger"></i>
                  </a>
                </td> 
            </tr>
            @php
                $nomor++;
                $id = 0;
            @endphp
            @endforeach         
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<x-modal.tambah jenis="Pengeluaran" />
<x-modal.hapus jenis="pengeluaran" url="/delete-data" />
<x-modal.update jenis="Pengeluaran" : kategori="{{DB::table('kategori_pengeluaran')->get()}}" />
<x-modal.tambah-kategori />

<script>
  // Modal Hapus
  const hapusModal = document.getElementById('hapus')
  hapusModal.addEventListener('show.bs.modal', event => {

  const button = event.relatedTarget
  const id = button.getAttribute('data-bs-idHapus')

  const modalInput = hapusModal.querySelector('.id')

  modalInput.value = id
  })

  // Modal Edit Data
  const editModal = document.getElementById('edit')
  editModal.addEventListener('show.bs.modal', event => {

  const buttonEdit = event.relatedTarget
  const idEdit = buttonEdit.getAttribute('idEdit')
  const idKategori = buttonEdit.getAttribute('idKategori')
  const kategori = buttonEdit.getAttribute('kategori')
  const ket = buttonEdit.getAttribute('ket')
  const tanggal = buttonEdit.getAttribute('tanggal')
  const nominal = buttonEdit.getAttribute('nominal')

  const modalId = editModal.querySelector('.idUpdate')
  const modalJenis = editModal.querySelector('#jenis')
  const modalKet = editModal.querySelector('#keterangan')
  const modalTgl = editModal.querySelector('#tanggal')
  const modalNom = editModal.querySelector('#nominal')

  modalId.value = idEdit
  modalJenis.value = idKategori+'-'+kategori
  modalKet.value = ket
  modalTgl.value = tanggal
  modalNom.value = nominal
  })
</script>



<x-footer />
