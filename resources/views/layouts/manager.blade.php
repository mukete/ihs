<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ihs &middot; manager</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('manager')}}/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="{{url('manager')}}/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <!-- inject:css -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{url('manager')}}/css/style.css">
  <link rel="stylesheet" href="{{url('manager')}}/css/swagger.css">
  <!-- endinject -->
  <!-- <link rel="shortcut icon" href="{{url('manager')}}/images/favicon.png" /> -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

  <style type="text/css">
    .navbar {
    font-weight: 400;
    -moz-transition: none;
    -ms-transition: none;
    -moz-box-shadow: none;
    box-shadow: none;
}

.table th, .table td {
    vertical-align: middle;
    line-height: 1;
    white-space: wrap;
}
  </style>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="-moz-transition: none;
    -ms-transition: none;
    -moz-box-shadow: none; box-shadow: none;" >
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: #10425E; width: 300px; border: solid 2px #10425E;">

        @if(auth()->user()->company->logo != null)
        <a class="navbar-brand brand-logo mr-5" href="{{url('manager/start')}}"><img src="{{url('content/logos/'.auth()->user()->company->logo)}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('manager/start')}}"><img src="{{url('content/logos/'.auth()->user()->company->logo)}}" alt="logo"/></a>
        @else
        <a class="navbar-brand brand-logo mr-5" href="{{url('manager/start')}}"><img src="{{url('ihs.png')}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('manager/start')}}"><img src="{{url('ihs.png')}}" alt="logo"/></a>
        @endif


      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="width: auto;" >
        <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="ti-view-list"></span>
        </button> -->
        
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown">
            <a href="{{url('/')}}">  User</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <!-- <i class="ti-bell mx-0"></i> -->
              <span class="material-icons-outlined align-middle" style="font-size: 2.0rem;">language</span>
               {{ LaravelLocalization::getCurrentLocaleNative() }}
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
              <!-- <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p> -->

              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

                <div class="item-content">
                  <p class="font-weight-light small-text mb-0 text-muted">
                    {{ $properties['native'] }}
                  </p>
                </div>
              </a>
              @endforeach
              
            </div>
          </li>



          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @if(auth()->user()->avatar == null)
              <img src="https://avatars.dicebear.com/v2/initials/{{auth()->user()->name}}.svg" >
              @else
              <img src="{{url('content/users/'.auth()->user()->avatar)}}" >
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ url('manager/settings') }}">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="ti-view-list"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">


        


        <ul class="nav">
          <div class="mx-auto text-center" style="width: 150px;">
            <!-- @if(auth()->user()->avatar == null)
              <img src="https://avatars.dicebear.com/v2/initials/{{auth()->user()->name}}.svg" class="mx-auto"  width="100" style="border-radius: 50px; border: 3px solid #ffffff;" >
              @else
              <img src="{{url('content/users/'.auth()->user()->avatar)}}" class="mx-auto"  width="100" style="border-radius: 50px; border: 3px solid #ffffff;" >
              @endif
            <br/><br/> -->
            <br/><br/>
            <h4 class="text-white">Hi {{auth()->user()->name}} !</h4>

            <hr style="border-bottom: 2px solid #ffffff;">
          </div>
          
          <li class="nav-item">
            <a class="nav-link" href="{{url('manager/start')}}">
              <span class="material-icons-outlined">dashboard</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/departments/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/departments')}}">
              <span class="material-icons-outlined">apartment</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Departments</span>
            </a>
          </li>

          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/categories/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/categories')}}">
              <span class="material-icons-outlined">category</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Categories</span>
            </a>
          </li>

          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/courses/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/courses')}}">
              <span class="material-icons-outlined">play_lesson</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Courses</span>
            </a>
          </li>

          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/questions/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/questions')}}">
              <span class="material-icons-outlined">quiz</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Questions</span>
            </a>
          </li>

          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/users/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/users')}}">
              <span class="material-icons-outlined">people</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Users</span>
            </a>
          </li>

         <!--  <li class="nav-item {!! Request::is(app()->getLocale().'/manager/certificates/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/certificates')}}">
              <span class="material-icons-outlined">card_membership</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Certificates</span>
            </a>
          </li> -->

          <li class="nav-item {!! Request::is(app()->getLocale().'/manager/settings/*') ? 'active' : '' !!}">
            <a class="nav-link" href="{{url('manager/settings')}}">
              <span class="material-icons-outlined">settings</span>&nbsp;&nbsp;&nbsp;
              <span class="menu-title">Settings</span>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- partial -->
      @yield('content')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> -->


  <!-- plugins:js -->
  <script src="{{url('manager')}}/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- <script src="{{url('manager')}}/vendors/chart.js/Chart.min.js"></script> -->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{url('manager')}}/js/off-canvas.js"></script>
  <script src="{{url('manager')}}/js/hoverable-collapse.js"></script>
  <script src="{{url('manager')}}/js/template.js"></script>
  <script src="{{url('manager')}}/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{url('manager')}}/js/dashboard.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <!-- End custom js for this page-->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script src="{{ url('sorttable.js') }}"></script>

  <script>
      $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      });
    </script>
</body>

</html>

