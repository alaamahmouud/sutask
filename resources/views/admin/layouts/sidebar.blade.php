<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <!-- <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            <li class="nav-item">
              <a class="nav-link" href="{{url('/home')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Home</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('products.index')}}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">Products</span>
              </a>
            </li>
          
        </div>
      </div>
    </div>
  </nav>