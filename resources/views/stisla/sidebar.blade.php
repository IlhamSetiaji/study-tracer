<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">Study Tracer</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">ST</a>
      </div>
      <ul class="sidebar-menu">
        @if (auth()->user()->hasRole('admin'))
          <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ url('/admin') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Akun</li>
            <li><a class="nav-link" href="{{ url('/admin/account') }}"><i class="fas fa-tachometer-alt"></i> <span>Akun</span></a></li>
        @elseif (auth()->user()->hasRole('guru'))
        <li class="menu-header">Daftar Study</li>
        <li><a class="nav-link" href="{{ url('/guru/study') }}"><i class="fas fa-user-plus"></i> <span>Daftar Study</span></a></li>
        @elseif (auth()->user()->hasRole('siswa'))
        <li class="menu-header">Daftar Study</li>
        <li><a class="nav-link" href="{{ url('/study') }}"><i class="fas fa-school"></i> <span>Daftar Study</span></a></li>
        @endif
      </ul>
{{--         <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div> --}}
    </aside>
  </div>