<x-header/>
<body>
    <x-navbar halaman="penghuni"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <div class="table-responsive">
            <table class="table table-sm">
              <tr>
                <th scope="col">
                  <h2>Penghuni</h2>
                </th>
                <th scope="col" style="text-align: right">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#tambahPenghuni">
                    <i data-feather="plus-circle" class="text-primary" style="width:36px;height:36px;"></i>
                  </a>
                </th>
              </tr>
            </table>
          </div>
        </div>

        <div class="table-responsive">
          @if (session('statusPenghuniBerhasil') !== null)
            <div class="alert alert-success alert-dismissible fade show">
              {{session('statusPenghuniBerhasil')}}
              <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('statusPenghuniGagal') !== null)
            <div class="alert alert-danger alert-dismissible fade show">
              {{session('statusPenghuniGagal')}}
              <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Nomor</th>  
                <th scope="col">Nama</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Status</th>
                <th scope="col">Nomor Kamar</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @php
                $nomor = 1;
              @endphp
              @foreach ($penghuni as $p)
                <tr>
                    <td>{{$nomor}}</td>
                    <td>{{$p->nama}}</td>
                    <td>{{$p->no_telepon}}</td>
                    <td>{{$p->status}}</td>
                    <td>{{$p->no_kamar}}</td>
                    <td>
                      <a type="button" data-bs-toggle="modal" data-bs-target="#updatePenghuni" idEdit="{{$p->id}}" nama="{{$p->nama}}" no_telepon="{{$p->no_telepon}}" status="{{$p->status}}" no_kamar="{{$p->no_kamar}}" id="editBtn">
                        <i data-feather="edit" class="text-primary"></i>
                      </a>
                    </td>
                    <td>
                      <a type="button" data-bs-toggle="modal" data-bs-target="#hapusPenghuni" idHapus="{{$p->id}}" nama="{{$p->nama}}" style="color: red;"  id="hapusBtn">
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3 class="h3">Riwayat Pembayaran 2022</h3>
        </div>

        <div class="table-responsive">
          @if (session('statusRiwayatBerhasil') !== null)
            <div class="alert alert-success alert-dismissible fade show">
              {{session('statusRiwayatBerhasil')}}
              <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Nomor</th>
                  <th scope="col">Nama</th>  
                  <th scope="col">Jan</th>
                  <th scope="col">Feb</th>
                  <th scope="col">Mar</th>
                  <th scope="col">Apr</th>
                  <th scope="col">Mei</th>
                  <th scope="col">Jun</th>
                  <th scope="col">Jul</th>
                  <th scope="col">Aug</th>
                  <th scope="col">Sep</th>
                  <th scope="col">Okt</th>
                  <th scope="col">Nov</th>
                  <th scope="col">Des</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $nomor = 1;
                  $bulan = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];
                @endphp
                @foreach ($statusPembayaran as $sp)
                <form action="{{url('/update-pembayaran')}}" method="post">
                  @csrf
                  <tr> 
                    @if ($penghuni->find($sp->id_penghuni)->status === 'Terdaftar')
                    <td>{{$nomor}}</td>
                    <td>{{$penghuni->find($sp->id_penghuni)->nama}}</td>
                    @foreach($bulan as $b)
                      @if (isset($sp->$b) && $sp->$b === 1)
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" id="{{$b}}" name="{{$b}}" checked>
                        </div>
                      </td>
                      @else
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" name="{{$b}}" id="{{$b}}">
                        </div>
                      </td>
                      @endif
                    @endforeach
                      <td>
                        <input type="hidden" id="id" name="id" value="{{$sp->id_penghuni}}"> 
                        <input type="hidden" id="nama" name="nama" value="{{$penghuni->find($sp->id_penghuni)->nama}}"> 
                        <button class="btn btn-sm btn-primary" type="submit">Update</button>
                      </td>
                  </tr> 
                </form>
                @php  
                  $nomor++;
                @endphp
                    @endif   
                @endforeach   
              </tbody>
            </table>    
          </div>

          <x-modal.tambah-penghuni/>
          <x-modal.update-penghuni/>
          <x-modal.hapus-penghuni/>

          

          <script>
              // Modal Update Data
              const editModal = document.getElementById('updatePenghuni')
              editModal.addEventListener('show.bs.modal', event => {

              const buttonEdit = event.relatedTarget
              const idEdit = buttonEdit.getAttribute('idEdit')
              const nama = buttonEdit.getAttribute('nama')
              const no_telepon = buttonEdit.getAttribute('no_telepon')
              const no_kamar = buttonEdit.getAttribute('no_kamar')
              const status = buttonEdit.getAttribute('status')

              const modalId = editModal.querySelector('#id')
              const modalNama = editModal.querySelector('#nama')
              const modalNo_telepon = editModal.querySelector('#no_telepon')
              const modalNo_kamar = editModal.querySelector('#no_kamar')
              const modalStatus = editModal.querySelector('#status')

              modalId.value = idEdit
              modalNama.value = nama
              modalNo_telepon.value = no_telepon
              modalNo_kamar.value = no_kamar
              modalStatus.value = status
              })

              // Modal Hapus Data
              const hapusModal = document.getElementById('hapusPenghuni')
              hapusModal.addEventListener('show.bs.modal', event => {

              const buttonHapus = event.relatedTarget
              const idHapus = buttonHapus.getAttribute('idHapus')
              const namaHapus = buttonHapus.getAttribute('nama')

              const modalHapusId = hapusModal.querySelector('.id')
              const modalBody = hapusModal.querySelector('.modal-body')
              const modalNamaHapus = hapusModal.querySelector('.nama')

              modalBody.innerText = "Apakah anda yakin akan menghapus penghuni dengan nama " + namaHapus + "? " + " Seluruh data yang berkaitan dengan penghuni ini juga akan terhapus."
              modalHapusId.value = idHapus 
              modalNamaHapus.value = namaHapus
              })
          </script>

    </main>
<x-footer />