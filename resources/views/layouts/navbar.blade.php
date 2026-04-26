     <nav class="app-header navbar navbar-expand bg-body">
         <!--begin::Container-->
         <div class="container-fluid">
             <!--begin::Start Navbar Links-->
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                         <i class="bi bi-list"></i>
                     </a>
                 </li>
                 <li class="nav-item d-none d-md-block">
                     <a href="#" class="nav-link">Inicio</a>
                 </li>
                 <li class="nav-item d-none d-md-block">
                     <a href="#" class="nav-link">Contacto</a>
                 </li>
             </ul>
             <!--end::Start Navbar Links-->

             <!--begin::End Navbar Links-->
             <ul class="navbar-nav ms-auto">

                 <!--begin::Fullscreen Toggle-->
                 <li class="nav-item">
                     <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                         <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                         <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                     </a>
                 </li>
                 <!--end::Fullscreen Toggle-->

                 <!--begin::User Menu Dropdown-->
                 <li class="nav-item dropdown user-menu">
                     <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                         <img src="{{ asset('assets/img/jake.jpg') }}" class="user-image rounded-circle shadow"
                             alt="User Image" />
                         <span class="d-none d-md-inline">Felipe</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                         <!--begin::User Image-->
                         <li class="user-header text-bg-primary">
                             <img src="{{ asset('assets/img/jake.jpg') }}" class="rounded-circle shadow"
                                 alt="User Image" />
                             <p>
                                 Mauricio - Project Manager(Backend Dev)
                                 <small>Member since Nov. 2023</small>
                             </p>
                         </li>
                         <!--end::User Image-->
                         <!--begin::Menu Body-->
                         <li class="user-body">
                             <!--begin::Row-->
                             <!--end::Row-->
                         </li>
                         <!--end::Menu Body-->
                         <!--begin::Menu Footer-->
                         <li class="user-footer">
                             <form action="{{url('/')}}" method="get" class="d-inline">
                                 @csrf
                                 <button type="submit" class="btn btn-outline-danger float-end">
                                     Cerrar Sesión
                                 </button>
                             </form>
                         </li>
                         <!--end::Menu Footer-->
                     </ul>
                 </li>
                 <!--end::User Menu Dropdown-->
             </ul>
             <!--end::End Navbar Links-->
         </div>
         <!--end::Container-->
     </nav>