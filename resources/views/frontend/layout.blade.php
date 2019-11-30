<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- <title>Divisima | eCommerce Template</title> -->
    <title>Single Page</title>
    <meta charset="UTF-8">
    <meta name="description" content=" Divisima | eCommerce Template">
    <meta name="keywords" content="divisima, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="851588212447-9o6vfep0r91fcqilbth1900igife0lnj.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!-- Favicon -->
    <link href="frontend/img/favicon.ico" rel="shortcut icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('/frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('/frontend/css/style.css') }}" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <div id="app">
        <!-- Header section -->
        <header class="header-section">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 text-center text-lg-left">
                            <!-- logo -->
                            <router-link to="/"><img src="frontend/img/logo.png" alt=""></router-link>
                        </div>
                        <search></search>
                        <div class="col-xl-4 col-lg-5">
                            <div class="user-panel">
                                <login-icon></login-icon>
                                <cart-icon></cart-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="main-navbar">
                <div class="container">
                    <!-- menu -->
                    <ul class="main-menu">
                        <li>
                            <router-link to="/">Home</router-link>
                        </li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Jewelry
                                <span class="new">New</span>
                            </a></li>
                        <li>
                            <router-link to="/products">Products</router-link>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="./product.html">Product Page</a></li>
                                <li><a href="./category.html">Category Page</a></li>
                                <li><a href="./cart.html">Cart Page</a></li>
                                <li><a href="./checkout.html">Checkout Page</a></li>
                                <li><a href="./contact.html">Contact Page</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Header section end -->
        <router-view></router-view>
    </div>

    <!-- Footer section -->
    <section class="footer-section">
        <div class="container">
            <div class="footer-logo text-center">
                <a href="index.html"><img src="./frontend/img/logo-light.png" alt=""></a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>About</h2>
                        <p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
                        <img src="frontend/img/cards.png" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Track Orders</a></li>
                            <li><a href="">Returns</a></li>
                            <li><a href="">Jobs</a></li>
                            <li><a href="">Shipping</a></li>
                            <li><a href="">Blog</a></li>
                        </ul>
                        <ul>
                            <li><a href="">Partners</a></li>
                            <li><a href="">Bloggers</a></li>
                            <li><a href="">Support</a></li>
                            <li><a href="">Terms of Use</a></li>
                            <li><a href="">Press</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <div class="fw-latest-post-widget">
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="frontend/img/blog-thumbs/1.jpg"></div>
                                <div class="lp-content">
                                    <h6>what shoes to wear</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="frontend/img/blog-thumbs/2.jpg"></div>
                                <div class="lp-content">
                                    <h6>trends this year</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget contact-widget">
                        <h2>Questions</h2>
                        <div class="con-info">
                            <span>C.</span>
                            <p>Your Company Ltd </p>
                        </div>
                        <div class="con-info">
                            <span>B.</span>
                            <p>1481 Creekside Lane Avila Beach, CA 93424, P.O. BOX 68 </p>
                        </div>
                        <div class="con-info">
                            <span>T.</span>
                            <p>+53 345 7953 32453</p>
                        </div>
                        <div class="con-info">
                            <span>E.</span>
                            <p>office@youremail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container">
                <div class="social-links">
                    <a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
                    <a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
                    <a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
                    <a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
                    <a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
                    <a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
                    <a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
                </div>

                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <p class="text-white text-center mt-5">Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </div>
        </div>
    </section>
    <!-- Footer section end -->

    <!--====== Javascripts & Jquery ======-->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/frontend/js/main.js') }}"></script>

</body>

</html>