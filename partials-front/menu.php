<?php include ($_SERVER['DOCUMENT_ROOT'].'/Moto_Krastev_Rent_&_Tour/config/constants.php');?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For slider in Routes Owl Carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"> 
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo SITEURL;?>/css/style.css" media="screen"/>
    <title>Moto Krastev Rent & Tour</title>
</head>
<body>
    <!--Start Header section-->
    <section class="header-contact">
        <div class="header-email">
            <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/545454/new-post.png" alt="new-post"/>
            <p>info@motokrastev.bg</p>
        </div>
        <div class="header-phones">
            <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/545454/apple-phone.png" alt="apple-phone"/>
            <p>+359 89 327 6008 / +359 88 554 6666</p>
        </div>
        <div class="header-work-time">
            <img width="20" height="20" src="https://img.icons8.com/ios-filled/50/545454/present.png" alt="present"/>
            <p>Пон - Съб - 10:00 - 18:00 / Неделя - почивен ден</p>
        </div>
        <div class="header-social">
            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/545454/facebook.png" alt="facebook"/>
            <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/545454/instagram-new.png" alt="instagram-new"/>
            <img width="28" height="28" src="https://img.icons8.com/ios-filled/50/545454/twitterx.png" alt="twitterx"/>
        </div>
    </section>
    <!--End Header section-->
    
    <!-- Start Navbar section -->
    <section class="navbar">
        <div class="container">
            <a href="<?php echo SITEURL; ?>index.php">
                <div class="logo">
                    <img src="<?php echo SITEURL; ?>images/logo.png" alt="" width="140px">
                </div>
            </a>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php" class="btn-menu">Начало</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo SITEURL; ?>rent.php" class="btn-menu">Наем</a>
                        <div class="content content-moto text-center">
                            <a href="<?php echo SITEURL; ?>rent.php?brand=Honda">Honda</a>
                            <a href="<?php echo SITEURL; ?>rent.php?brand=Yamaha">Yamaha</a>
                            <a href="<?php echo SITEURL; ?>rent.php?brand=Suzuki">Suzuki</a>
                            <a href="<?php echo SITEURL; ?>rent.php?brand=BMW">BMW</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo SITEURL; ?>routes.php" class="btn-menu">Маршрути</a>
                        <div class="content content-routes text-center">
                            <a href="<?php echo SITEURL; ?>routes.php?country=България">България</a>
                            <a href="<?php echo SITEURL; ?>routes.php?country=Румъния">Румъния</a>
                            <a href="<?php echo SITEURL; ?>routes.php?country=Турция">Турция</a>
                            <a href="<?php echo SITEURL; ?>routes.php?country=Гърция">Гърция</a>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>about.php" class="btn-menu">Относно</a>
                    </li>
                </ul>
            </div>
            <br>
            <div class="clearfix"></div>
        </div>
    </section>

    <section class="navbar-mobile">
        <nav role="navigation">
            
            <div class="menuToggle">
                <input type="checkbox" />
                <a href="<?php echo SITEURL; ?>index.php">
                    <div class="logo-mobile">
                        <img src="<?php echo SITEURL;?>images/logo.png" alt="" width="140px">
                    </div>
                </a>
                    <span></span>
                    <span></span>
                    <span></span>
                <ul class="menu-mobile text-center">
                    <a href="<?php echo SITEURL; ?>index.php"><div class="btn-menu-mobile"><li>Начало</li></div></a>
                    <a href="<?php echo SITEURL; ?>rent.php"><div class="btn-menu-mobile"><li>Наем</li></div></a>
                    <a href="<?php echo SITEURL; ?>routes.php"><div class="btn-menu-mobile"><li>Маршрути</li></div></a>
                    <a href="<?php echo SITEURL; ?>about.php"><div class="btn-menu-mobile"><li>Относно</li></div></a>
                </ul>
            </div>
        </nav>

    </section>
    <!-- End Navbar section -->