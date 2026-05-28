<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Titus Tuitoek - Property Buyers Agent'; ?></title>

    <link rel="icon" href="assets/images/logo-2.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="assets/css/font-awesome-all.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/owl.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/elpath.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
</head>

<body>
<div class="boxed_wrapper">

    <!-- mouse-pointer -->
    <div class="mouse-pointer" id="mouse-pointer"></div>

    <!-- preloader -->
    <div class="loader-wrap">
        <div class="preloader">
            <div class="preloader-close">x</div>
            <div id="handle-preloader" class="handle-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <?php
                        $letters = ['t','i','t','u','s','b','u','y','e','r','s'];
                        $upper   = ['T','I','T','U','S','B','U','Y','E','R','S'];
                        foreach ($letters as $i => $l):
                        ?>
                        <span data-text-preloader="<?php echo $l; ?>" class="letters-loading"><?php echo $upper[$i]; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Popup -->
    <div id="search-popup" class="search-popup">
        <div class="popup-inner">
            <div class="upper-box clearfix">
                <figure class="logo-box pull-left">
                    <a href="index.php"><img src="assets/images/logo.png" alt="Titus Tuitoek"></a>
                </figure>
                <div class="close-search pull-right"><span class="far fa-times"></span></div>
            </div>
            <div class="overlay-layer"></div>
            <div class="auto-container">
                <div class="search-form">
                    <form method="get" action="index.php">
                        <div class="form-group">
                            <fieldset>
                                <input type="search" class="form-control" name="s" placeholder="Type your keyword and hit" required>
                                <button type="submit"><i class="far fa-search"></i></button>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="xs-sidebar-group info-group info-sidebar">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-overlay xs-overlay-2 xs-bg-black"></div>
        <div class="xs-overlay xs-overlay-3 xs-bg-black"></div>
        <div class="xs-overlay xs-overlay-4 xs-bg-black"></div>
        <div class="xs-overlay xs-overlay-5 xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget"><i class="fa fa-times"></i></a>
                </div>
                <div class="sidebar-textwidget">
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="index.php"><img src="assets/images/logo.png" alt="Titus Tuitoek Buyers Agent"></a>
                            </div>
                            <div class="content-box">
                                <h4>About Us</h4>
                                <p>As Perth's trusted property buyers advocate, we bring over 5 years of market expertise to help you secure your ideal property. Our deep understanding of the Western Australian real estate market ensures you make informed decisions with confidence.</p>
                                <p>We pride ourselves on providing personalized service, expert negotiation, and thorough due diligence to save you time, money, and stress in your property journey.</p>
                                <a href="about.php" class="theme-btn btn-one">About Us</a>
                            </div>
                            <div class="contact-info">
                                <h4>Contact Info</h4>
                                <ul>
                                    <li><i class="far fa-map-marker-alt"></i> Perth City, Western Australia</li>
                                    <li><i class="far fa-phone"></i><a href="tel:+61498439115">+61 498 439 115</a></li>
                                    <li><i class="far fa-envelope"></i><a href="mailto:titus.buyersagent@gmail.com">titus.buyersagent@gmail.com</a></li>
                                </ul>
                            </div>
                            <ul class="social-box">
                                <li class="facebook"><a href="https://facebook.com/titusbuyersagent" class="fab fa-facebook-f" aria-label="Facebook"></a></li>
                                <li class="twitter"><a href="https://twitter.com/titusbuyersagent" class="fab fa-twitter" aria-label="Twitter"></a></li>
                                <li class="linkedin"><a href="https://linkedin.com/in/titustuitoek" class="fab fa-linkedin-in" aria-label="LinkedIn"></a></li>
                                <li class="instagram"><a href="https://instagram.com/titusbuyersagent" class="fab fa-instagram" aria-label="Instagram"></a></li>
                                <li class="youtube"><a href="https://youtube.com/@titusbuyersagent" class="fab fa-youtube" aria-label="YouTube"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header header-style-two">
        <div class="header-lower">
            <div class="large-container">
                <div class="outer-box">
                    <div class="logo-box">
                        <figure class="logo">
                            <a href="index.php"><img src="assets/images/logo.png" alt="Titus Tuitoek"></a>
                        </figure>
                    </div>
                    <div class="menu-area">
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <?php
                                    $nav = [
                                        'home'    => ['label' => 'Home',     'url' => 'index.php'],
                                        'about'   => ['label' => 'About',    'url' => 'about.php'],
                                        'service' => ['label' => 'Services', 'url' => 'service.php'],
                                        'contact' => ['label' => 'Contact',  'url' => 'contact.php'],
                                    ];
                                    foreach ($nav as $key => $item):
                                        $active = (isset($current_page) && $current_page === $key) ? ' class="current"' : '';
                                    ?>
                                    <li<?php echo $active; ?>><a href="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </nav>
                        <div class="menu-right-content">
                            <div class="search-box-outer search-toggler"><i class="icon-1"></i></div>
                            <div class="nav-btn nav-toggler navSidebar-button"><i class="icon-2"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Header -->
        <div class="sticky-header">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo">
                        <a href="index.php"><img src="assets/images/logo.png" alt="Titus Tuitoek"></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix"><!-- Menu via JavaScript --></nav>
                    <div class="menu-right-content">
                        <div class="search-box-outer search-toggler"><i class="icon-1"></i></div>
                        <div class="nav-btn nav-toggler navSidebar-button"><i class="icon-2"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="index.php"><img src="assets/images/logo-2.png" alt="Titus Tuitoek" title=""></a>
            </div>
            <div class="menu-outer"><!-- Menu via JavaScript --></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Perth City, Western Australia</li>
                    <li><a href="tel:+61498439115">+61 498 439 115</a></li>
                    <li><a href="mailto:titus.buyersagent@gmail.com">titus.buyersagent@gmail.com</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="https://twitter.com/titusbuyersagent"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="https://facebook.com/titusbuyersagent"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="https://instagram.com/titusbuyersagent"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="https://linkedin.com/in/titustuitoek"><span class="fab fa-linkedin"></span></a></li>
                    <li><a href="https://youtube.com/@titusbuyersagent"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div>
