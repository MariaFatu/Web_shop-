<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>@yield('title')</title>
 <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/fontawesome.min.css">
 <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script
src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-default navbar-static-top">
 <div class="container">
 <!-- Right Side Of Navbar -->
 <ul class="nav navbar-nav navbar-right">
 <!-- Authentication Links -->
 @if (Auth::guest())
 <li><a href="{{ route('login') }}">Login</a></li>
 <li><a href="{{ route('register') }}">Register</a></li>
 @else
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ariaexpanded="false">
 {{ Auth::user()->name }} <span class="caret"></span>
 </a>
 <ul class="dropdown-menu" role="menu">
 <li>
 <a href="{{ route('logout') }}"
 onclick="event.preventDefault();
 document.getElementById('logout-form').submit();">
 Logout
 </a>
 <form id="logout-form" action="{{ route('logout') }}" method="POST"
style="display: none;">
 {{ csrf_field() }}
 </form>
 </li>
 </ul>
 </li>
 @endif
 </ul>
 </div>
 </div>
 </nav>
 @if ((!Auth::guest() && (Auth::user()->id > 2)))
<div class="container">
 <div class="row">
 <div class="col-lg-12 col-sm-12 col-12 main-section">
 <div class="dropdown">
 <button type="button" class="btn btn-info" data-toggle="dropdown">
 <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cos <span class="badge
badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
 </button>
 <div class="dropdown-menu">
 <div class="row total-header-section">
 <div class="col-lg-6 col-sm-6 col-6">
 <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge
badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
 </div>
 <?php $total = 0 ?>
 @foreach((array) session('cart') as $id => $details)
 <?php $total += $details['price'] * $details['quantity'] ?>
 @endforeach
 <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
 <p>Total: <span class="text-info">$ {{ $total }}</span></p>
 </div>
 </div> 
 @if(session('cart'))
 @foreach(session('cart') as $id => $details)
 <div class="row cart-detail">
 <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
 
 <img src="{{ asset('/images/'.$details['image']) }}"
width="70" height="70" class="img-responsive"/>
 </div>
 <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
 <p>{{ $details['name'] }}</p>
 <span class="price text-info"> ${{ $details['price'] }}</span> <span
class="count"> Cantitate:{{ $details['quantity'] }}</span>
 </div>
 </div>
 @endforeach
 @endif
 <div class="row">
 <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
 <a href="{{ url('cart') }}" class="btn btn-primary btn-block">Afisare tot</a>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
</div>
@endif
<div class="container page">
 @yield('content')
</div>
@yield('scripts')
</body>
</html>