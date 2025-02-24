<nav
class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
>
<div class="container-fluid">
  <nav
    class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
  >
  <h3 class="fw-bold mb-3">
    {{-- {{ $cooperative->name ?? 'Mass-Specc Cooperative' }} --}}
</h3>
  </nav>

  <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
    <li class="nav-item topbar-user dropdown hidden-caret">

      <a
        class="dropdown-toggle profile-pic"
        data-bs-toggle="dropdown"
        href="#"
        aria-expanded="false"
      >
      <i class="fa fa-user"></i>
        <span class="profile-username">
          <span class="op-7">Hi,</span>
          <span class="fw-bold" style="text-transform: capitalize;">
            {{ Auth::user()->name }}
        </span>

        </span>
      </a>
      <ul class="dropdown-menu dropdown-user animated fadeIn">
        <div class="dropdown-user-scroll scrollbar-outer">
          <li>
            <div class="user-box">
              <div class="u-text">
                <h4> {{ Auth::user()->name }}</h4>
                <p class="text-muted"> {{ Auth::user()->email }}</p>
              </div>
            </div>
          </li>
          <li>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('participant.profile.user.edit') }}">My Profile</a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                @csrf
            </form>
            <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
          </li>
        </div>
      </ul>
    </li>
  </ul>
</div>
</nav>
