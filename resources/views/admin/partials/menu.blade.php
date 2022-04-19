
      <li class="nav-item mT-30 active">
        <a class='sidebar-link' href="{{ route(ADMIN . '.dash') }}" default>
          <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
          </span>
          <span class="title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class='sidebar-link' href="{{ route(ADMIN . '.users.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
          </span>
          <span class="title">Donatur</span>
        </a>
      </li>

      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.coa.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-bookmark"></i>
          </span>
              <span class="title">CoA</span>
          </a>
      </li>

      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.categories.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-bookmark"></i>
          </span>
              <span class="title">Kategori</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.programs.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-bookmark"></i>
          </span>
              <span class="title">Program</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.zakat.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-money"></i>
          </span>
              <span class="title">Transaksi Zakat</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.transactions.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-money"></i>
          </span>
              <span class="title">Transaksi Semua Program</span>
          </a>
      </li>

      {{--Todo: Fix Employee Management--}}
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.employees.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
          </span>
              <span class="title">Karyawan</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.roles.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
          </span>
              <span class="title">Role</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.permissions.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-user"></i>
          </span>
              <span class="title">Permission</span>
          </a>
      </li>
      <li class="nav-item">
          <a class='sidebar-link' href="{{ route(ADMIN . '.site.settings.index') }}">
          <span class="icon-holder">
            <i class="c-brown-500 ti-settings"></i>
          </span>
              <span class="title">Site Settings</span>
          </a>
      </li>