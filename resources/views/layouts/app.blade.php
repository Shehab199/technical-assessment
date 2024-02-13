<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/css/aos.css">
    <link rel="stylesheet" href="/css/style.css">


    <title>Technical Assesment @hasSection('title')
            - @yield('title')
        @endif
    </title>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <div class="container">
        <nav class="site-nav">
            <div class="row justify-content-between align-items-center">
                <div class="d-none d-lg-block col-lg-3 top-menu">
                    {{--  --}}
                </div>
                <div class="col-3 text-lg-center logo">
                    <a href="/">Story<span class="text-primary">.</span> </a>
                </div>
                <div class="col-9 col-md-6 col-lg-3 text-right top-menu">
                    <div class="d-inline-flex align-items-center">
                        <span class="mx-2 d-inline-block d-lg-none"></span>

                        <a href="#" class="burger ml-3 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                            data-toggle="collapse" data-target="#main-navbar">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="d-none d-lg-block row align-items-center py-3">
                <div class="col-12 col-sm-12 col-lg-12 site-navigation text-center">
                    <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu">
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                        <li class="{{ Request::is('most-viewed') ? 'active' : '' }}"><a href="/most-viewed">Most
                                Viewed</a></li>
                        <li class="{{ Request::is('most-emailed') ? 'active' : '' }}"><a href="/most-emailed">Most
                                Emailed</a></li>
                        <li class="{{ Request::is('most-shared') ? 'active' : '' }}"><a href="/most-shared">Most
                                Shared</a></li>
                        @guest
                            <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="/login">Login</a></li>
                            <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="/register">Register</a></li>
                        @endguest

                        @auth
                            <li class="{{ Request::is('saved-articles') ? 'active' : '' }}"><a
                                    href="/saved-articles">Saved</a></li>
                            <li class="{{ Request::is('logout') ? 'active' : '' }}"><a href="/logout">Logout</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav> <!-- END nav -->
    </div> <!-- END container -->

    @yield('content')

    <div class="site-footer">
        <div class="container">
            <div class="row justify-content-center copyright">

                <div class="col-lg-7 text-center">

                    {{-- <div class="widget">
              <ul class="social list-unstyled">
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                <li><a href="#"><span class="icon-youtube-play"></span></a></li>
              </ul>
            </div> --}}

                    <div class="widget">
                        <p>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>. All Rights Reserved.
                        </p>
                    </div>

                </div>


            </div>

            <div id="overlayer"></div>
            <div class="loader">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <script src="/js/jquery-3.4.1.min.js"></script>
            <script src="/js/popper.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/owl.carousel.min.js"></script>
            <script src="/js/aos.js"></script>
            <script src="/js/imagesloaded.pkgd.js"></script>
            <script src="/js/isotope.pkgd.min.js"></script>
            <script src="/js/jquery.animateNumber.min.js"></script>
            <script src="/js/jquery.waypoints.min.js"></script>
            <script src="/js/jquery.fancybox.min.js"></script>
            <script src="/js/custom.js"></script>

            <script>
                $(document).ready(function() {
                    // Save article on button click
                    $('.save-article').on('click', function() {
                        var articleId = $(this).closest('.article').data('id');
                        console.log(articleId)
                        var button = $(this);
                        var newContent = $(this).data('content');

                        $.ajax({
                            url: '/save-article',
                            method: 'POST',
                            data: {
                                article_id: articleId
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(newContent)
                                if (newContent == '9734') {
                                    console.log(newContent)
                                    button.html('&#9733;');
                                    button.data('content', '9733');
                                } else {
                                    console.log(newContent)
                                    button.html('&#9734;');
                                    button.data('content', '9734');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script>

</body>

</html>
