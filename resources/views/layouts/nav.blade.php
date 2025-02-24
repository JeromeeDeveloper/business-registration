<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="{{ url('/') }}" class="navbar-brand p-0">
            <img class="logo-mass-specc" src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                {{-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Agenda</a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ url('/agenda') }}" class="dropdown-item">Agenda Grid</a>
                        <a href="{{ url('/detail') }}" class="dropdown-item">Agenda Detail</a>
                    </div>
                </div> --}}
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0">

                        <a href="{{ url('/feature') }}" class="dropdown-item">Our Features</a>

                        <a href="{{ route('home_participants.index') }}" class="dropdown-item">Participants</a>

                    </div>
                </div>
                <a href="{{ url('/contact') }}" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            </div>
            <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </button>
            <a href="{{ url('/login') }}" class="btn btn-primary py-2 px-4 ms-3">Login</a>
        </div>
    </nav>

    <!-- Dynamic About Section -->
    <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">
                    @switch(Request::path())
                        @case('about')
                            About Us
                            @break

                        @case('agenda')
                            Agenda & Updates
                            @break
                        @case('detail')
                            Agenda Detail
                            @break

                        @case('feature')
                            Features
                            @break

                        @case('participant')
                            Participant
                            @break

                        @case('contact')
                            Contact Us
                            @break
                        @default
                            About Us
                    @endswitch
                </h1>
                <a href="{{ url('/') }}" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="{{ url('/' . Request::path()) }}" class="h5 text-white">
                    @switch(Request::path())
                        @case('about')
                            About
                            @break

                        @case('agenda')
                            Agenda
                            @break
                        @case('detail')
                            Agenda Detail
                            @break

                        @case('feature')
                            Features
                            @break

                        @case('participant')
                            Participant
                            @break

                        @case('contact')
                            Contact
                            @break
                        @default
                            About
                    @endswitch
                </a>
            </div>
        </div>
    </div>
</div>
