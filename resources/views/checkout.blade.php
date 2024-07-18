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
						<a href="#" class="user-profile dropdown-toggle pb-4 text-dark" id="navbarDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false" style="color: #9daea8 !important; text-decoration: none;">
							{{ Auth::user()->name }}
							<img style="padding-left: 10px" src="{{ url('assets/images/user.svg') }}" alt="">
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
							<li>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
								<a class="dropdown-item" href="#"
									onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
						<h1>Checkout</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<div class="untree_co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mb-5 mb-md-0">
					<h2 class="h3 mb-3 text-black">Billing Details</h2>
					<div class="p-3 p-lg-5 border bg-white">
						<div class="form-group row">
							<form id="form1" action="{{ url('checkout') }}" method="POST" enctype="multipart/form-data">
								@csrf

								<div class="col-md-12">
									<label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="c_fname" name="name" value="{{ auth()->user()->name }}">
								</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="c_address" name="address" placeholder="Street address">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number">
							</div>
						</div>
						<div class="form-group row mb-5">
							<div class="col-md-12">
								<label for="buktibayar" class="text-black">Upload Bukti Bayar <span class="text-danger">*</span></label>
								<input type="file" class="form-control" id="buktibayar" name="buktibayar" accept="image/*">
							</div>
						</div>
					</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row mb-5">
						<div class="col-md-12">
							<h2 class="h3 mb-3 text-black">Your Order</h2>
							<div class="p-3 p-lg-5 border bg-white">
								<table class="table site-block-order-table mb-5">
									<thead>
										<tr>
											<th>Product</th>
											<th>Quantity</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										@foreach($cartItems as $item)
										<tr>
											<td>{{ $item->nama }}</td>
											<td>{{ $item->quantity }}</td>
											<td>Rp. {{ number_format($item->harga * $item->quantity) }}</td>
										</tr>
										@endforeach
										<tr>
											<td class="text-black font-weight-bold" colspan="2"><strong>Order Total</strong></td>
											<td class="text-black font-weight-bold"><strong>Rp. {{ number_format($totalHarga) }}</strong></td>
										</tr>
									</tbody>
								</table>
								

								<div class="border p-3 mb-3">
									<h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button"
											aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

									<div class="collapse" id="collapsebank">
										<div class="py-2">
											<p class="mb-0">Silahkan Transfer ke Rek:</p>
											<p class="mb-0">Mandiri:01213180121</p>
											<p class="mb-0">BRI:01213180121</p>
										</div>
									</div>
								</div>

								<div class="form-group">
									<button class="btn btn-black btn-lg py-3 btn-block" id="submitAllForms">Place
										Order</button>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- </form> -->
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
					<p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada.
						Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>

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
								<li><a href="#">Contact us</a></li>
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

						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li><a href="#">Nordic Chair</a></li>
								<li><a href="#">Kruzo Aero</a></li>
								<li><a href="#">Ergonomic Chair</a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>

			<div class="border-top copyright">
				<div class="row pt-4">
					<div class="col-lg-6">
						<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
								document.write(new Date().getFullYear());
							</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>
							Distributed By <a hreff="https://themewagon.com">ThemeWagon</a>
							<!-- License information: https://untree.co/license/ -->
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

	<script>
    document.getElementById('submitAllForms').addEventListener('click', function() {
    // Submit the first form
    document.getElementById('form1').submit();
	});
    </script>
	@include('include.templatejs')
</body>

</html>