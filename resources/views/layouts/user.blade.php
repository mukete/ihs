<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ihs</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="{{url('user')}}/css/main.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <!-- production version, optimized for size and speed -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <style type="text/css">
    aside.aside .aside-tools {
    display: flex;
    flex-direction: row;
    width: 100%;
    /*background-color: #17191e;*/
    background-color: #20415D;
    color: #fff;
    line-height: 3.25rem;
    height: 3.25rem;
    padding-left: 1.0rem;
    flex: 1;
    padding-top: 2.0rem;
    padding-bottom: 4.0rem;
}

.menu-list a {
    border-radius: 0;
    color: #ffffff;
    display: block;
    padding: 0.5rem 0;
}
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.min.js" integrity="sha512-XdUZ5nrNkVySQBnnM5vzDqHai823Spoq1W3pJoQwomQja+o4Nw0Ew1ppxo5bhF2vMug6sfibhKWcNJsG8Vj9tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </style>
</head>
<body>
<div id="app">
  <nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
        <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
      </a>
      <div class="navbar-item has-control">
        <!-- <div class="control"><input placeholder="Search everywhere..." class="input"></div> -->
      </div>
    </div>
    <div class="navbar-brand is-right">
      <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
        <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
      </a>
    </div>
    <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
      <div class="navbar-end">

        @if( auth()->user()->type == 'admin' )
        <a class="navbar-item is-desktop-icon-only-" href="{{ url('root/start') }}">                           
          <span class="icon"><i class="mdi mdi-account-cog"></i></span>
          <span>root </span>
        </a>

        <a class="navbar-item is-desktop-icon-only-" href="{{ url('manager/start') }}">                           
          <span class="icon"><i class="mdi mdi-account-cog"></i></span>
          <span>manager </span>
        </a>
        @endif
        

        @if( auth()->user()->type == 'manager' )
        <a class="navbar-item is-desktop-icon-only-" href="{{ url('manager/start') }}">                           
          <span class="icon"><i class="mdi mdi-account-cog"></i></span>
          <span>manager </span>
        </a>
        @endif


        <div class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
          <a class="navbar-link is-arrowless">
            
            <div class="is-user-name"><span>  <span class="fa fa-globe"></span> {{ LaravelLocalization::getCurrentLocaleNative() }} </span></div>
            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
          </a>
          <div class="navbar-dropdown">
            

            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a  class="navbar-item" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">

              {{ $properties['native'] }}

            </a>
              @endforeach


          </div>
        </div>
        
        <div class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
          <a class="navbar-link is-arrowless">
            <div class="is-user-avatar">
              @if(auth()->user()->avatar == null)
              <img src="https://avatars.dicebear.com/v2/initials/{{auth()->user()->name}}.svg" >
              @else
              <img src="{{url('content/users/'.auth()->user()->avatar)}}" >
              @endif
            </div>
            <div class="is-user-name"><span>{{auth()->user()->name}}</span></div>
            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
          </a>
          <div class="navbar-dropdown">
            <a href="{{url('profil')}}"  class="navbar-item">
              <span class="icon"><i class="mdi mdi-account"></i></span>
              <span>{{trans('fe.profile')}}</span>
            </a>
            <a href="{{url('settings')}}" class="navbar-item">
              <span class="icon"><i class="mdi mdi-settings"></i></span>
              <span>{{trans('fe.settings')}}</span>
            </a>
            
            <hr class="navbar-divider">
            <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
              <span class="icon"><i class="mdi mdi-logout"></i></span>
              <span>{{trans('fe.logout')}}</span>
            </a>


          </div>
        </div>
        
        <a class="navbar-item is-desktop-icon-only" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
          <span class="icon"><i class="mdi mdi-logout"></i></span>
          <span>Log out</span>
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        

                                    
      </div>
    </div>
  </nav>
  <aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div class="aside-tools-label">
        <!-- <span><b></b> ihs</span> -->
        <span>
          @if(auth()->user()->company->logo != null)
          <img src="{{url('content/logos/'.auth()->user()->company->logo)}}" width="60%">
          @else
          <img src="{{url('ihs.png')}}" width="60%">
          @endif
        </span>
      </div>
    </div>
    <div class="menu is-menu-main">
      
      <ul class="menu-list">
        <li>
          <a href="{{url('/')}}" class="has-icon {{Request::is(app()->getLocale().'') ? 'is-active router-link-active' : ''}}">
            <span class="icon"><span class="material-icons-outlined">dashboard</span></span>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{url('kurses')}}" class="has-icon {{Request::is(app()->getLocale().'/kurse*') ? 'is-active router-link-active' : ''}} ">
            <span class="icon"><span class="material-icons-outlined">library_books</span></span>
            <span class="menu-item-label">Kurse</span>
          </a>
        </li>
        <li>
          <a href="{{url('zertifikate')}}" class="has-icon {{Request::is(app()->getLocale().'/zertifikate') ? 'is-active router-link-active' : ''}} ">
            <span class="icon"><span class="material-icons-outlined">card_membership</span></span>
            <span class="menu-item-label">Zertifikate</span>
          </a>
        </li>
        <li>
          <a href="{{url('profil')}}" class="has-icon {{Request::is(app()->getLocale().'/profil') ? 'is-active router-link-active' : ''}} ">
            <span class="icon"><span class="material-icons-outlined">person</span></span>
            <span class="menu-item-label">Profil</span>
          </a>
        </li>
        <!-- <li>
          <a href="{{url('mitteilungen')}}" class="has-icon {{Request::is(app()->getLocale().'/mitteilungen') ? 'is-active router-link-active' : ''}}">
            <span class="icon"><span class="material-icons-outlined">chat</span></span>
            <span class="menu-item-label">Mitteilungen</span>
          </a>
        </li> -->
        <li>
          <a href="{{url('settings')}}" class="has-icon {{Request::is(app()->getLocale().'/settings') ? 'is-active router-link-active' : ''}}">
            <span class="icon"><span class="material-icons-outlined">settings</span></span>
            <span class="menu-item-label">Settings</span>
          </a>
        </li>
        
      </ul>
      
    </div>
  </aside>

  <section class="section is-title-bar">
   <div class="level">
      <div class="level-left">
         <div class="level-item">
            <ul>
               <!-- <li>ihs</li> -->
               <li class="is-size-6 has-text-weight-light">{{$title}} <br/>---</li>
            </ul>
         </div>
      </div>
      <!-- <div class="level-right">
         <div class="level-item">
            <div class="buttons is-right">
               
            </div>
         </div>
      </div> -->
   </div>
</section>

  @yield('content')

  <!-- <footer class="footer">
    <div class="container-fluid">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            &copy; {{date('Y')}} ihs.
          </div>
          <div class="level-item">
            
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <div class="logo">
              <a href="https://justboil.me"><img src="img/justboil-logo.svg" alt="JustBoil.me"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer> -->
</div>

<div id="sample-modal" class="modal">
  <div class="modal-background jb-modal-close"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Confirm action</p>
      <button class="delete jb-modal-close" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <p>This will permanently delete <b>Some Object</b></p>
      <p>This is sample modal</p>
    </section>
    <footer class="modal-card-foot">
      <button class="button jb-modal-close">Cancel</button>
      <button class="button is-danger jb-modal-close">Delete</button>
    </footer>
  </div>
  <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="{{url('user')}}/js/main.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script> -->
<!-- <script type="text/javascript" src="{{url('user')}}/js/chart.sample.min.js"></script> -->

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>
