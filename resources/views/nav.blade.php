<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="index.html">
                    <!-- <img src="images/logo.png" alt="" /> --><span>Penjualan Buku</span></a></div>
                    <li class="label">Main</li>
                    <li><a href="/dashboard"><i class="ti-dashboard"></i> Dashboard </a></li>
                    <br>
                    <li class="label">Apps</li>
                    @if(Auth::User()->level->level == "Admin")
                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i> User <span
                        class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                         <li><a href="/users">Users</a></li>
                         <li><a href="/workers">Workers</a></li>
                         <li><a href="/departments">Departments</a></li>
                     </ul>
                 </li>
                 @endif
                 @if(Auth::User()->level->level == "head" )
                 <li><a href="/departments/members/0"><i class="ti-user"></i> Members</a></li>
                 @endif

                 <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Data <span
                    class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="/books">Book</a></li>
                        <li><a href="/transaction_in">Purchase Income</a></li>
                        <li><a href="/transaction_out">Purchase Outcome </a></li>
                    </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Tickets <span
                    class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                      @if(Auth::User()->level->level == "head" || Auth::User()->worker->user_id == Auth::User()->worker->department->head_id )
                      <li><a href="/tickets">All</a></li>
                      @endif
                      <li><a href="/tickets/assign">Assign</a></li>
                      <li><a href="/tickets/made">Made</a></li>
                      @if(Auth::User()->level->level == "head" || Auth::User()->level->level == "Admin")
                      <li><a href="/topics">Topic</a></li>
                      @endif
                  </ul>
              </li>

              @if(Auth::User()->level->level == "Admin" || Auth::User()->level->level == "head")
              <li><a href="/laporan"><i class="ti-files"></i>Laporan</a></li>
              @endif
              <br>
              <li class="label">Account</li>
              <li><a href="/profile"><i class="ti-info-alt"></i> Profile</a></li>
              <li><a href="/Logout"><i class="ti-close"></i> Logout</a></li>
          </ul>
      </div>
  </div>
</div>
<!-- /# sidebar -->









<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="float-left">
                    <div class="hamburger sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </div>
                </div>
                <div class="float-right">

                    <div class="header-icon" data-toggle="dropdown">
                        <span class="user-avatar">
                         @if(isset(Auth::user()->photo))
                         <img class="m-r-10 avatar-img"src="{{ asset('storage/images/avatar/'. Auth::user()->photo) }}" alt="" />
                         @else()
                         <img class="m-r-10 avatar-img"src="/images/avatar/default.jpg" alt="" />
                         @endif

                         {{Auth::user()->worker->name}}
                     </span>

                 </div>
             </div>
         </div>
     </div>
 </div>
</div>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Hello, <span>Welcome {{Auth::user()->worker->name}}</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            