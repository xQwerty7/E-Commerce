<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  
  <!-- Bootstrap CSS -->
  @include('include.templatecss')
  <title>Furni</title>
</head>

<body>

<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="/">Furni<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item ">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item active"><a class="nav-link" href="/shop">Shop</a></li>
                <li><a class="nav-link" href="/contact">Contact us</a></li>
            </ul>
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown" style="padding-right: 20px; padding-top: 8px;">
                        <a href="#" class="user-profile dropdown-toggle pb-4 text-dark" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #9daea8 !important; text-decoration: none;">
                            {{ Auth::user()->name }}
                            <img style="padding-left: 10px" src="{{ url('assets/images/user.svg') }}" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/orders">Orders</a>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </li>
                <li><a class="nav-link" href="{{ url('cart') }}"><img src="{{ url('assets/images/cart.svg') }}"></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Header/Navigation -->

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Search and Sort Section -->
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <form action="{{ url('/shop') }}" method="GET" id="filterForm">
            <div class="row mb-5">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request()->input('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-control" onchange="document.getElementById('filterForm').submit();">
                        <option value="">Semua Kategori</option>
                        @foreach($kategory as $kat)
                        <option value="{{ $kat->id }}" {{ request()->input('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach ($stok as $item)
            @php
                // Uraikan JSON menjadi array untuk setiap item
                $images = json_decode($item->foto_barang, true);
                // Ambil gambar pertama
                $firstImage = $images[0] ?? null;
            @endphp
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="/detail/{{ $item->id }}">
                    <img src="{{ asset('fotobarang/' . $firstImage) }}" class="img-fluid product-thumbnail" style="width: 100%; height: 300px; object-fit: contain;">
                    <h3 class="product-title">{{ $item->nama }}</h3>
                    <strong class="product-price">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</strong>
                    <span class="icon-cross">
                        <img src="{{ url('assets/images/cross.svg') }}" class="img-fluid">
                    </span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Search and Sort Section -->

<!-- Start Footer Section -->
<footer class="footer-section">
    <div class="container relative">
        <div class="sofa-img">
            <img src="{{ url('assets/images/sofa.png') }}" alt="Image" class="img-fluid">
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
                <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>
                <ul class="list-unstyled custom-social">
                    <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="/contact">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Knowledge base</a></li>
                            <li><a href="#">Live chat</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Our team</a></li>
                            <li><a href="#">Leadership</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> &amp; distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Section -->

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategorySelect = document.querySelector('select[name="kategori"]');
        kategorySelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>
@include('include.templatejs')

</body>
</html>
