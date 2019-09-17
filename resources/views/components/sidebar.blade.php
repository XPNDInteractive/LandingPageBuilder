    <div class="p-3 bg-light border-bottom  w-100">
        <div class="row  m-0 align-items-center">
            <i class="d-none p-3 px-4 display-4 bg-primary text-primary  text-center fas fa-building"></i>
            <div class="col p-0">

                <p class=" mb-1 text-nowrap small"><i class="fas fa-user mr-1 text-primary text-primary"></i> {{ Auth::user()->name }}</p>
                @if(isset($company))
                <p class=" mb-1 text-nowrap small"><i class="fas fa-building mr-1 text-primary text-primary"></i> {{ $company->name }}</p>
                @endif
                <p class=" mb-1 text-nowrap small"><i class="fas fa-envelope mr-1 text-primary text-primary"></i> {{ Auth::user()->email }}</p>

            </div>
        </div>
        <a href="#" class="btn btn-primary  btn-sm mt-3">Account</a>
        <a class="btn btn-outline-primary  btn-sm mt-3" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    <ul class="nav flex-column ">
        <li class="nav-item py-1  border-bottom">
            <a class="nav-link small"><i class="fas fa-server  mr-1 text-primary "></i> Sites</a>
        </li>
        <li class="nav-item py-1 border-bottom ">
            <a class="nav-link small"><i class="fas fa-server  mr-1 text-primary "></i> Pages</a>
        </li>
        <li class="nav-item py-1  border-bottom">
            <a class="nav-link small" href="/templates"><i class="fas fa-server  mr-1 text-primary "></i> Templates</a>
        </li>
        <li class="nav-item py-1  border-bottom">
            <a class="nav-link small" href="/layouts"><i class="fas fa-server  mr-1 text-primary "></i> Layouts</a>
        </li>
       
    
     
        <li class="nav-item py-1  border-bottom">
            <a class="nav-link small" href="/lookup"><i class="fas fa-server  mr-1 text-primary "></i> Lookup</a>
        </li>
      


         <li class="nav-item py-1  border-bottom">
            <a class="nav-link small"><i class="fas fa-users mr-1 text-primary "></i> Users</a>
        </li>
         <li class="nav-item py-1  border-bottom">
            <a class="nav-link small"><i class="fas fa-book mr-1 text-primary "></i> Documentation</a>
        </li>
         <li class="nav-item py-1  border-bottom">
            <a class="nav-link small"><i class="fas fa-life-ring mr-1 text-primary "></i> Support</a>
        </li>
         <li class="nav-item py-1  border-bottom">
            <a class="nav-link small"><i class="fas fa-cog mr-1 text-primary "></i> Settings</a>
        </li>

    </ul>
    <ul class="nav flex-column mt-auto d-none">
            <li class="nav-item py-1 border-bottom border-top">
                <a class="nav-link small"><i class="fas fa-user-circle  mr-1 text-primary "></i> Account</a>
            </li>
             <li class="nav-item py-1 ">
                <a class="nav-link small"><i class="fas fa-users mr-1 text-primary "></i> Sign Out</a>
            </li>


        </ul>
