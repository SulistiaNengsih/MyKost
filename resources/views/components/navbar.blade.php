<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">MyKost</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="" aria-label="Search">
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="#">Sign out</a>
      </div>
    </div>
</header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3 sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              @if ($halaman === "pembukuan")
              <a class="nav-link active" aria-current="page" href="{{url('/pembukuan-pengeluaran')}}">
              @else
              <a class="nav-link" aria-current="page" href="{{url('/pembukuan-pengeluaran')}}">
              @endif
              <span data-feather="file" class="align-text-bottom"></span>
                Pembukuan
              </a>
            </li>

            <li class="nav-item">
              @if ($halaman === "kost")
              <a class="nav-link active" href="{{url('/kost')}}">
              @else
              <a class="nav-link" href="{{url('/kost')}}">
              @endif
                <span data-feather="home" class="align-text-bottom"></span>
                Kost
              </a>
            </li>

            <li class="nav-item">
              @if ($halaman === "penghuni")
              <a class="nav-link active" href="{{url('/penghuni')}}">
              @else
              <a class="nav-link" href="{{url('/penghuni')}}">
              @endif
                <span data-feather="users" class="align-text-bottom"></span>
                Penghuni
              </a>
            </li>

            <li class="nav-item">
              @if($halaman === "rekapData")
              <a class="nav-link active" href="{{url('/rekap-data')}}">
              @else
              <a class="nav-link" href="{{url('/rekap-data')}}">
              @endif
                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                Rekap Data
              </a>
            </li>
          </ul>
        </div>
      </nav>