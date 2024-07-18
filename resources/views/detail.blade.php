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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/cssdetail/lightslider.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('assets/cssdetail/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/magnific-popup.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('assets/cssdetail/style.css') }}">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
      .product_slider_img {
    overflow: hidden;
    height: 400px; /* Sesuaikan dengan tinggi maksimum gambar */
}

.product_slider_img img {
    max-width: 100%;
    max-height: 400px; /* Atur tinggi maksimum sesuai kebutuhan */
    object-fit: cover;
    display: block;
    margin: auto;
}
    </style>

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
								<h1>Detail</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		
		<!-- Start Contact Form -->    
    <div class="untree_co-section">
      <div class="container">

        <div class="block">
          <div class="row justify-content-center">
              <div class="product_image_area section_padding">
                  <div class="container">
                      <div class="row s_product_inner justify-content-between">
                          <div class="col-lg-7 col-xl-7">
                              <div class="product_slider_img">
                                  <div id="vertical">
                                      @if($stok->foto_barang)
                                          @php
                                              $images = json_decode($stok->foto_barang);
                                          @endphp
                                          @foreach ($images as $item)
                                              <div data-thumb="{{ asset('fotobarang/' . $item) }}">
                                                  <img src="{{ asset('fotobarang/' . $item) }}" />
                                              </div>
                                          @endforeach
                                      @endif
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-5 col-xl-4">
                              <div class="s_product_text">
                                  <h5>previous <span>|</span> next</h5>
                                  <h3>{{ $stok->nama }}</h3>
                                  <h2>Rp. {{number_format($stok->harga_jual) }}</h2>
                                  <ul class="list">
                                      <li>
                                          <a class="active" href="#">
                                              <span>Category</span> : {{ $stok->namakategori }}
                                          </a>
                                      </li>
                                      <li>
                                          <a href="#">
                                              <span>Availability</span> :
                                              @if($stok->saldoakhir == 0)
                                                  Not In Stock
                                              @else
                                                  In Stock
                                              @endif
                                          </a>
                                      </li>
                                  </ul>
                                  <p>{{ $stok->deskripsi_barang }}</p>
                                  <div class="card_area d-flex justify-content-between align-items-center">
                                    <div class="product_count">

                                      <input class="input-number" type="number" value="1" min="1" max="100" id="quantity">

                                  </div>
                                  
                                  <form action="{{ route('addToCart', $stok->id) }}" method="POST">
                                      @csrf
                                      <input type="hidden" name="quantity" id="form-quantity" value="1">
                                      <button type="submit" class="btn_3">add to cart</button>
                                  </form>
                                      <a href="#" class="like_us"><i class='bx bxs-heart'></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
              <!--================End Single Product Area =================-->
            
              <!--================Product Description Area =================-->
              <section class="product_description_area">
                <div class="container">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Description</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro at assumenda voluptate doloribus est dolorem suscipit, dignissimos facere molestias neque praesentium ullam nisi totam non tempore, illum veritatis dolorum fugiat!
                      </p>
                      <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat, praesentium, beatae facilis ratione voluptate iusto, vel minima necessitatibus fuga asperiores sed nulla quam cum cumque hic molestias architecto laudantium molestiae!
                      </p>
                    </div>
                  </div>
                </div>
              </section>
          </div>

        </div>

      </div>


    </div>


  <!-- End Contact Form -->

		

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
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a hreff="https://themewagon.com">ThemeWagon</a>  <!-- License information: https://untree.co/license/ -->
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
      document.addEventListener('DOMContentLoaded', function() {
          let quantityInput = document.getElementById('quantity');
          let formQuantityInput = document.getElementById('form-quantity');
          
          quantityInput.addEventListener('input', function () {
              let currentValue = parseInt(quantityInput.value);
              if (currentValue >= parseInt(quantityInput.getAttribute('min')) && currentValue <= parseInt(quantityInput.getAttribute('max'))) {
                  formQuantityInput.value = currentValue;
              }
          });
      });
  </script>

		    @include('include.templatejs')
        <script src="{{ url('assets/jsdetail/jquery-1.12.1.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ url('assets/jsdetail/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ url('assets/jsdetail/bootstrap.min.js') }}"></script>
        <!-- easing js -->
        <script src="{{ url('assets/jsdetail/jquery.magnific-popup.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ url('assets/jsdetail/lightslider.min.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ url('assets/jsdetail/masonry.pkgd.js') }}"></script>
        <!-- particles js -->
        <script src="{{ url('assets/jsdetail/owl.carousel.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/jquery.nice-select.min.js') }}"></script>
        <!-- slick js -->
        <script src="{{ url('assets/jsdetail/slick.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/swiper.jquery.js') }}"></script>
        <script src="{{ url('assets/jsdetail/jquery.counterup.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/waypoints.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/contact.js') }}"></script>
        <script src="{{ url('assets/jsdetail/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/jquery.form.js') }}"></script>
        <script src="{{ url('assets/jsdetail/jquery.validate.min.js') }}"></script>
        <script src="{{ url('assets/jsdetail/mail-script.js') }}"></script>
        <script src="{{ url('assets/jsdetail/stellar.js') }}"></script>
        <!-- custom js -->
        <script src="{{ url('assets/jsdetail/theme.js') }}"></script>
        <script src="{{ url('assets/jsdetail/custom.js') }}"></script>


	</body>

</html>
