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
    <h4 class="h4">Kategori Pengeluaran</h4>
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
                  <a data-bs-toggle="modal" data-bs-target="#editKategori" idEdit="{{$kp->id}}" jenis="{{$kp->jenis_pengeluaran}}" id="editBtn">
                    <i data-feather="edit" class="text-primary"></i>
                  </a>
                </td>
                <td scope="col">
                  <a data-bs-toggle="modal" data-bs-target="#hapusKategori" data-bs-idHapus="{{$kp->id}}" style="color: red;" type="button" id="hapusBtn">
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

      <hr>

      {{-- Tabel Pemasukan --}}
      <h4 class="h4">Kategori Pemasukan</h4>
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
                  <a data-bs-toggle="modal" data-bs-target="#editKategori" idEdit="{{$kp->id}}" jenis="{{$kp->jenis_pemasukan}}" id="editBtn">
                    <i data-feather="edit" class="text-primary"></i>
                  </a>
                </td>
                <td scope="col">
                  <a data-bs-toggle="modal" data-bs-target="#hapusKategori" data-bs-idHapus="{{$kp->id}}" style="color: red;" type="button" id="hapusBtn">
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

  {{-- Modal Tambah Kategori --}}
  <x-modal.tambah-kategori />

<x-footer />