<nav class="navbar navbar-expand-md navbar-dark bg-primary  p-0 shadow">

        <a style="width: 280px; background: rgba(0,0,0, 0.3);" class="d-flex align-items-center pl-3  navbar-brand p-0 font-weight-bold h-100" href="{{ url('/') }}">
            {XPND}Interactive
        </a>



            <!-- Left Side Of Navbar -->

            @guest
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif



            </ul>

            @else


            @endguest

</nav>
