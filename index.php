<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Libary -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <!-- Libary -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;600;700&family=Hind+Madurai:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    <title>Maharaja Palace</title>
</head>

<body>
    <!-- header -->
    <header class="hero-container">
        <!-- Barra de navegacion -->
        <?php 
            include "./parts/nav.php";
        ?>
        <!-- Barra de navegacion -->

        <!-- contenido del hero -->
        <div class="hero-main">
            <section class="hero-text-container">
                <h2 class="hero-title">Title</h2>
                <p class="hero-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos, quasi. Eos,
                    nostrum? Ea aliquid soluta error quam sunt? Fugit velit sunt suscipit optio molestiae officiis
                    veritatis laborum perspiciatis, quae in.</p>
                <div class="cta-container">
                    <a class="btn-main" href="./description.html">Order Now</a>
                </div>
            </section>
            <div class="hero-image-container">
                <img class="hero-image" src="./imgs/platillo-1.png" alt="hero-image">
            </div>
        </div>
        <!-- contenido del hero -->
    </header>
    <!-- header -->

    <!-- main -->
    <main>
        <!-- slider -->
        <section class="featured-dishes">
            <h2 class="section-title">Featured Dishes</h2>
            <div class="underscore"></div>
            <!-- Slider main container -->
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/aloo-gosht.jpg.webp" alt="aloo-gosht">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.php">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/butter-chicken.jpg.webp" alt="butter-chicken">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.php">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/chapati.jpg.webp" alt="chapati">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/kulfi.jpg.webp" alt="kulfi">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/malai-kofta.jpg.webp" alt="malai-kofta">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/raita.jpg.webp" alt="raita">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/malai-kofta.jpg.webp" alt="malai-kofta">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/raita.jpg.webp" alt="raita">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/kulfi.jpg.webp" alt="kulfi">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-slider">
                            <img class="slider-img" src="./imgs/malai-kofta.jpg.webp" alt="malai-kofta">
                            <div class="card-content main-bg">
                                <div class="slider-text">
                                    <h3>Title</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </div>
                                <div class="btn-slider-container">
                                    <a class="btn-secondary link-text" href="./description.html">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Slides -->
                </div>
                
                <!-- pagination -->
                <div class="swiper-pagination"></div>
    
                <!--  navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <!-- Slider main container -->
            
        </section>
        <!-- slider -->

        <!-- menu -->
        <section class="menu-container">
            <h2 class="section-title">Categories</h2>
            <div class="underscore"></div>
    
            
            <div class="menu">
                <a class="link-text" href="./menu.php">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image" src="./imgs/bebida.png" alt="beverage image">
                        </div>
                        <div class="card-content">
                                <h4>Appetizers</h4>                        
                        </div>
                    </div>
                </a>
    
            <a class="link-text" href="./menu.php">
                <div class="card-menu">
                    <div class="card-image-container">
                        <img class="card-image" src="./imgs/bebida.png" alt="beverage image">
                    </div>
                    <div class="card-content">
                            <h4 class="categories-text">Main courses</h4>
                    </div>
                </div>
            </a>
    
                <a class="link-text" href="./menu.php">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image" src="./imgs/bebida.png" alt="beverage image">
                        </div>
                        <div class="card-content">
                                <h4 class="categories-text">Desserts</h4>
                        </div>
                    </div>
                </a>
    
                <a class="link-text" href="./menu.php">
                    <div class="card-menu">
                        <div class="card-image-container">
                            <img class="card-image" src="./imgs/bebida.png" alt="beverage image">
                        </div>
                        <div class="card-content">
                                <h4 class="categories-text">Beverages</h4>                        
                        </div>
                    </div>
                </a>
    
            </div>
    
        </section>
        <!-- menu -->
    </main>
        <!-- main -->

    <!-- footer -->
    <?php 
        include "./parts/footer.php";
    ?>
    <!-- footer -->
    <script src="./js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>

</html>