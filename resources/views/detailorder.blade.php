<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
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
						<li><a class="nav-link" href="/shop">Shop</a></li>
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
                <div>
                  <div>
                    <h1>Order Details - No Bukti: {{ $rec->first()->nobukti }}</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Hero Section -->
        
          <div class="container" style="padding-top: 50px">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rec as $detail)
                        <tr>
                            <td>{{ $detail->nama }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp.{{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>
        </div>
		<!-- End Hero Section -->

		

		<div class="untree_co-section product-section before-footer-section">
		    <div class="container">
		      	<div class="row">
		      	</div>
		    </div>
		</div>


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
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
            </p>
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


@include('include.templatejs')
	</body>

</html>
