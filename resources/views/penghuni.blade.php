<x-header/>
<body>
    <x-navbar halaman="penghuni"/>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap border-bottom flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h2 class="h2">Data Kost</h2>
      </div>

      @php
          function formatRupiah($angka) {
            $hasil = "Rp " . number_format($angka,2,',','.');
            return $hasil;
          }
      @endphp

      @if (session('statusBerhasil') !== null)
        <div class="alert alert-success alert-dismissible fade show">
          {{session('statusBerhasil')}}
          <button type="button" class="btn-close" style="text-align: right;" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">{{$kost->nama}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Biaya sewa bulanan {{formatRupiah($kost->biaya_sewa_bulanan)}}</h6>
            <p class="card-text">{{$kost->alamat}}</p>
            <p class="card-text"><small class="text-muted">Jumlah penghuni: {{$penghuni->count()}}</small></p>
          </div>
      </div>
      <a type="button" idKost="{{$kost->id}}" namaKost="{{$kost->nama}}" alamatKost="{{$kost->alamat}}" biayaKost="{{$kost->biaya_sewa_bulanan}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKost" style="float: right;">Edit Data Kost</a>
        
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
              @if ($penghuni->count() > 0)
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
              @else
                <h6 class="h6">Anda belum memiliki penghuni kost</h6>
              @endif
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <div class="table-responsive">
            <table class="table table-sm">
              <tr>
                <th scope="col">
                  <h2>Riwayat Pembayaran</h2>
                </th>
                <th scope="col" style="text-align: right">
                  <a type="button" data-bs-toggle="modal" data-bs-target="#tambahRiwayatBayar">
                    <i data-feather="plus-circle" class="text-primary" style="width:36px;height:36px;"></i>
                  </a>
                </th>
              </tr>
            </table>
          </div>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif

        @if ($statusPembayaran->count() > 0)
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nomor</th>  
              <th scope="col">Nama Penghuni</th>
              <th scope="col">Tahun</th>
              <th scope="col">Bulan</th>
              <th scope="col">Tanggal Pembayaran</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @php
              $nomor = 1;
            @endphp
              @foreach ($statusPembayaran as $sp)
              <tr>
                  <td>{{$nomor}}</td>
                  <td>{{$penghuni->find($sp->id_penghuni)->nama}}</td>
                  <td>{{$tahun->find($sp->id_tahun)->tahun}}</td>
                  <td>{{$bulan->find($sp->id_bulan)->bulan}}</td>
                  <td>{{$sp->tanggal_bayar}}</td>
                  <td>
                    <a type="button" data-bs-toggle="modal" id="updateBayarBtn" data-bs-target="#updateRiwayatBayar" 
                    idEdit="{{$sp->id}}"
                    idPenghuni="{{$sp->id_penghuni}}"
                    idTahun="{{$sp->id_tahun}}"
                    idBulan="{{$sp->id_bulan}}"
                    tanggalBayar="{{$sp->tanggal_bayar}}"
                    foto="{{$sp->foto_bukti_bayar}}"
                    >
                      <i data-feather="edit" class="text-primary"></i>
                    </a>
                  </td>
                  <td>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#hapusRiwayatBayar" idHapus="{{$sp->id}}" style="color: red;"  id="hapusBayarBtn">
                      <i data-feather="trash-2" class="text-danger"></i>
                    </a>
                  </td>
              </tr> 
              @php
                $nomor++;
              @endphp   
              @endforeach 
            @else
              <h6 class="h6">Anda belum memiliki riwayat pembayaran kost.</h6>
            @endif
          </tbody>
        </table>

            <x-modal.update-kost />
            <x-modal.tambah-penghuni/>
            <x-modal.update-penghuni/>
            <x-modal.hapus-penghuni/>
            <x-modal.hapus-riwayat-bayar/>
            <x-modal.tambah-riwayat-bayar/>
            <x-modal.update-riwayat-bayar/>
          </div>
  
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

              // Modal Update Kost
              const updateKostModal = document.getElementById('editKost')
              updateKostModal.addEventListener('show.bs.modal', event => {

                const updateKostId = updateKostModal.querySelector('#id')
                const updateNamaKost = updateKostModal.querySelector('#nama')
                
                updateKostId.value = {{$kost->id}}
              })

              // Modal Update Riwayat Bayar
              const updateRiwayatBayarModal = document.getElementById('updateRiwayatBayar')
              updateRiwayatBayarModal.addEventListener('show.bs.modal', event => {

                const buttonUpdateRb = event.relatedTarget
                const idEdit = buttonUpdateRb.getAttribute('idEdit')
                const idPenghuni = buttonUpdateRb.getAttribute('idPenghuni')
                const idTahun = buttonUpdateRb.getAttribute('idTahun')
                const idBulan = buttonUpdateRb.getAttribute('idBulan')
                const tanggal = buttonUpdateRb.getAttribute('tanggalBayar')
                const foto = buttonUpdateRb.getAttribute('foto')
                
                const updateRiwayatBayarId = updateRiwayatBayarModal.querySelector('#id')
                const updateRiwayatBayarIdPenghuni = updateRiwayatBayarModal.querySelector('#idPenghuni')
                const updateRiwayatBayarIdTahun = updateRiwayatBayarModal.querySelector('#idTahun')
                const updateRiwayatBayarIdBulan = updateRiwayatBayarModal.querySelector('#idBulan')
                const updateRiwayatBayarTanggal = updateRiwayatBayarModal.querySelector('#tanggal')
                const modalFoto = updateRiwayatBayarModal.querySelector('#img')
                const modalFotoLabel = updateRiwayatBayarModal.querySelector('#img-label')

                updateRiwayatBayarId.value = idEdit
                updateRiwayatBayarIdPenghuni.value = idPenghuni
                updateRiwayatBayarIdTahun.value = idTahun
                updateRiwayatBayarIdBulan.value = idBulan
                updateRiwayatBayarTanggal.value = tanggal
                
                if (foto != "") {
                  modalFoto.style = ""
                  modalFotoLabel.style = ""
                  modalFoto.src = "storage/"+foto
                } else {
                  modalFoto.style = "display:none;"
                  modalFotoLabel.style = "display:none"
                }
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

              // Modal Hapus Riwayat Pembayaran
              const hapusRiwayatModal = document.getElementById('hapusRiwayatBayar')
              hapusRiwayatModal.addEventListener('show.bs.modal', event => {

                const buttonHapus = event.relatedTarget
                const idHapus = buttonHapus.getAttribute('idHapus')

                const modalHapusId = hapusRiwayatModal.querySelector('.id')

                modalHapusId.value = idHapus 
              })
          </script>

    </main>
<x-footer />