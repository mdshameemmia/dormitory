 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
         <div class=" mx-1">DMS Software</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     @can('access')
         <li class="nav-item active">
             <a class="nav-link" href="{{ url('/dashboard') }}">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dashboard</span></a>
         </li>

         <li class="nav-item active">
             <a class="nav-link" href="{{ route('dormitory.index') }}">
                 <i class="fas fa-fw fa-building"></i>
                 <span>Dormitory</span></a>
         </li>

         <li class="nav-item active">
             <a class="nav-link" href="{{ route('room-type.index') }}">
                 <i class="fas fa-fw fa-building"></i>
                 <span>Room Type</span></a>
         </li>
         <li class="nav-item active">
             <a class="nav-link" href="{{ route('room.index') }}">
                 <i class="fas fa-fw fa-building"></i>
                 <span>Room</span></a>
         </li>

         <li class="nav-item active">
             <a class="nav-link" href="{{ route('student-dormitory.index') }}">
                 <i class="fas fa-fw fa-user"></i>
                 <span>Student Dormitory Management</span></a>
         </li>
     @endcan

     @can('access-any')
         <li class="nav-item active">
             <a class="nav-link" href="{{ route('user.index') }}">
                 <i class="fas fa-fw fa-users"></i>
                 <span>User</span></a>
         </li>
     @endcan

 </ul>
 <!-- End of Sidebar -->
