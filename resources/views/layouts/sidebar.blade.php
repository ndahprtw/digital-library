<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" class="dark-logo" width="180" alt="" />
        <img src="{{ asset('assets/images/logos/light-logo.svg') }}" class="light-logo"  width="180" alt="" />
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8 text-muted"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
          <a class="sidebar-link" href="/dashboard" aria-expanded="false">
            <span>
              <i class="ti ti-aperture"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        @can('manage users')
          <li class="sidebar-item">
            <a class="sidebar-link" href="/user" aria-expanded="false">
              <span>
                <i class="ti ti-user"></i>
              </span>
              <span class="hide-menu">User</span>
            </a>
          </li>
        @endcan
        @can('view categories')
          <li class="sidebar-item">
            <a class="sidebar-link" href="/kategori" aria-expanded="false">
              <span>
                <i class="ti ti-shopping-cart"></i>
              </span>
              <span class="hide-menu">Kategori</span>
            </a>
          </li>
        @endcan
        @can('view books')
          <li class="sidebar-item">
            <a class="sidebar-link" href="/buku" aria-expanded="false">
              <span>
                <i class="ti ti-currency-dollar"></i>
              </span>
              <span class="hide-menu">Buku</span>
            </a>
          </li>
        @endcan
        @can('borrow books')
          <li class="sidebar-item">
            <a class="sidebar-link" href="/pinjam" aria-expanded="false">
              <span>
                <i class="ti ti-cpu"></i>
              </span>
              <span class="hide-menu">Peminjaman</span>
            </a>
          </li>
        @endcan
        <li class="sidebar-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault(); this.closest('form').submit();">
                    <span>
                        <i class="ti ti-activity-heartbeat"></i>
                    </span>
                    <span class="hide-menu">Logout</span>
                </a>
            </form>
        </li>
      </ul>


      {{-- <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
        <div class="d-flex">
          <div class="unlimited-access-title">
            <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Unlimited Access</h6>
            <button class="btn btn-primary fs-2 fw-semibold lh-sm">Signup</button>
          </div>
          <div class="unlimited-access-img">
            <img src="{{ asset('assets/images/backgrounds/rocket.png') }}" alt="" class="img-fluid">
          </div>
        </div>
      </div> --}}
    </nav>
    
    {{-- <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
      <div class="hstack gap-3">
        <div class="john-img">
          <img src="{{ asset('assets/images/profile/user-1') }}" class="rounded-circle" width="40" height="40" alt="">
        </div>
        <div class="john-title">
          <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
          <span class="fs-2 text-dark">Designer</span>
        </div>
        <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
          <i class="ti ti-power fs-6"></i>
        </button>
      </div>
    </div>   --}}
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>