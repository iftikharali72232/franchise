  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{route('home')}}" class="logo d-flex align-items-center">
        <img src="<?= asset("img/logo.png") ?>" alt="">
        <span class="d-none d-lg-block">{{ trans('lang.labeey') }}{{Session::get('branch_id')}}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
<?php

  use Illuminate\Support\Facades\DB;

  $new_users = DB::select('SELECT id,name, user_type, created_at FROM users WHERE is_read =0 AND user_type != 0 ORDER BY id DESC'); ?>
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <a href="{{ url('lang/en') }}" class="mx-30px">English</a>
        <a href="{{ url('lang/ar') }}">العربية</a>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">{{count($new_users)}}</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu {{ app()->isLocale('ar') ? 'dropdown-menu-start' : 'dropdown-menu-end' }} dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            {{trans('lang.you_have')}} {{count($new_users)}} {{trans('lang.new_notifications')}}
              <a href=""><span class="badge rounded-pill bg-primary p-2 ms-2">{{trans('lang.read_all')}}</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a> End Messages Icon 

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
            {{trans('lang.you_have')}} 3 {{trans('lang.new_messages')}}
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">{{trans('lang.view_all')}}</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">{{trans('lang.show_all_messages')}}</a>
            </li>

          </ul> End Messages Dropdown Items 

        </li> -->
        <!-- End Messages Nav -->

      </ul>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ trans('lang.logout') }}
        </a>


        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->