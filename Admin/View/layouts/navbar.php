<nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar"
>

  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    <ul class="navbar-nav flex-row align-items-center ms-auto">

      <!-- user -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">

        <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="/Admin/public/assets/img/avatars/1.png"
                 class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end">

          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="me-3">
                  <img src="/Admin/public/assets/img/avatars/1.png"
                       class="w-px-40 rounded-circle" />
                </div>
                <div>
                  <span class="fw-semibold d-block">Admin</span>
                  <small class="text-muted">Quản trị</small>
                </div>
              </div>
            </a>
          </li>

          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-user me-2"></i> Profile
            </a>
          </li>

          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i> Settings
            </a>
          </li>

          <li><hr class="dropdown-divider"></li>

          <li>
            <a class="dropdown-item" href="/Client/index.php?page=logout">
              <i class="bx bx-power-off me-2"></i> Logout
            </a>
          </li>

        </ul>

      </li>
      <!--/ user -->

    </ul>

  </div>
</nav>