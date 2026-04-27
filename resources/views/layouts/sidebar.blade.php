      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
          <!--begin::Sidebar Brand-->
          <div class="sidebar-brand">
              <!--begin::Brand Link-->
              <a href="{{ route('users.index') }}" class="brand-link">
                  <!--begin::Brand Image-->
                  <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                      class="brand-image opacity-75 shadow" />
                  <!--end::Brand Image-->
                  <!--begin::Brand Text-->
                  <span class="brand-text fw-light">Flotilla Vehicular</span>
                  <!--end::Brand Text-->
              </a>
              <!--end::Brand Link-->
          </div>
          <!--end::Sidebar Brand-->
          <!--begin::Sidebar Wrapper-->
          <div class="sidebar-wrapper">
              <nav class="mt-2">
                  <!--begin::Sidebar Menu-->
                  <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                      aria-label="Main navigation" data-accordion="false" id="navigation">
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-people-fill"></i>
                              <p>
                                  Usuarios
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('users.create') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Registrar</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('users.index') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Todos</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link">
                              <i class="nav-icon bi bi-briefcase-fill"></i>
                              <p>
                                  Vehiculos
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('vehicles.create') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Registrar</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('vehicles.index') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Todos</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-box-seam-fill"></i>
                              <p>
                                  Solicitudes
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('vehicle-requests.create') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Registrar</p>
                                  </a>
                              </li>

                          </ul>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('vehicle-requests.index') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Todos</p>
                                  </a>
                              </li>

                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-shuffle"></i>
                              <p>
                                  Mantenimientos
                                  <span class="nav-badge badge text-bg-secondary me-3">6</span>
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('maintenances.index') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Todos</p>
                                  </a>
                              </li>

                          </ul>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('maintenances.create') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Registrar</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-cone-striped"></i>
                              <p>
                                  Viajes
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('trips.create') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Registrar</p>
                                  </a>
                              </li>

                          </ul>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('trips.index') }}" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Todos</p>
                                  </a>
                              </li>

                          </ul>
                      </li>


                      <li class="nav-header">EXAMPLES</li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon bi bi-box-arrow-in-right"></i>
                              <p>
                                  Auth
                                  <i class="nav-arrow bi bi-chevron-right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="#" class="nav-link">
                                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                      <p>
                                          Version 1
                                          <i class="nav-arrow bi bi-chevron-right"></i>
                                      </p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="./examples/login.html" class="nav-link">
                                              <i class="nav-icon bi bi-circle"></i>
                                              <p>Login</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="./examples/register.html" class="nav-link">
                                              <i class="nav-icon bi bi-circle"></i>
                                              <p>Register</p>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                              <li class="nav-item">
                                  <a href="#" class="nav-link">
                                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                      <p>
                                          Version 2
                                          <i class="nav-arrow bi bi-chevron-right"></i>
                                      </p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="./examples/login-v2.html" class="nav-link">
                                              <i class="nav-icon bi bi-circle"></i>
                                              <p>Login</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="./examples/register-v2.html" class="nav-link">
                                              <i class="nav-icon bi bi-circle"></i>
                                              <p>Register</p>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                              <li class="nav-item">
                                  <a href="./examples/lockscreen.html" class="nav-link">
                                      <i class="nav-icon bi bi-circle"></i>
                                      <p>Lockscreen</p>
                                  </a>
                              </li>
                          </ul>
                  </ul>
                  <!--end::Sidebar Menu-->
              </nav>
          </div>
          <!--end::Sidebar Wrapper-->
      </aside>