<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text">Car Services</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->is('dashboard')) active @endif">
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>{{__('Dashboard')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Section') }}
    </div>

    <li class="nav-item @if(request()->is('admin')) active @endif">
        <a class="nav-link" href="{{ route('admin.index') }}"><i class="fas fa-user-alt"></i><span>{{ __('Client') }}</span></a>
    </li>

    <li class="nav-item @if(request()->is('category')) active @endif">
        <a class="nav-link" href="{{ route('category.index') }}"><i class="fas fa-address-card"></i><span>{{__('Category')}}</span></a>
    </li>

    <li class="nav-item @if(request()->is('worker')) active @endif">
        <a class="nav-link" href="{{ route('worker.index') }}"><i class="fas fa-male"></i><span>{{ __('Worker') }}</span></a>
    </li>
    <li class="nav-item @if(request()->is('appointment')) active @endif">
        <a class="nav-link" href="{{ route('appointment.index') }}"><i class="fas fa-tasks"></i><span>{{ __('Appointment') }}</span></a>
    </li>

    <li class="nav-item @if(request()->is('request')) active @endif">
        <a class="nav-link" href="{{ route('request.index') }}"><i class="fas fa-envelope-open"></i><span>{{ __('Request') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
