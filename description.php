<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Description</title>
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
        <div class="hero-main-description">
            <section class="hero-text-container">
                <h2 class="hero-title hero-title-hindu">शीर्षक</h2>
                <p class="hero-text hero-text-hindu">
                    लोरेम इप्सम डोलर सिट अमेट कंसेक्टेचर, एडिपिसिंग एलीट। डिग्निसिमोस, अर्ध.
                    ईओस,
                    नॉस्ट्रम? क्या एक तरल घुलनशीलता त्रुटि है? फुगिट वेलिट संट ससिपिट ऑप्टियो मोलेस्टे ऑफिसिस
                    वेरिटैटिस लेबोरम पर्सपिसियाटिस, क्यूई इन।
                </p>
                <p class="hero-text hero-text-hindu">₹99.99</p>    
                <div class="description-btn-container">
                    <div class="quantity-container">
                        <button class="quantity-btn">-</button>
                        <input class="quantity-input" type="text">
                        <button class="quantity-btn">+</button>
                    </div>
                    <a class="btn-main" href="#">Order Now</a>
                </div>
            </section>
            <div class="hero-image-container">
                <img class="hero-image" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="hero-image">
            </div>
        </div>
        
    </header>
    <!-- header -->

    <!-- main -->
    <main>
        <section class="related-products">
            <h2 class="section-title">Related Products</h2>
            <div class="underscore"></div>
        
            <!-- Cards -->
            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>
    
            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>
            
            <div class="related-products-container">
                <div class="related-img-container">
                    <img class="related-products-img" src="./imgs/Shemins-Butter-Chicken-LR.jpg" alt="coca-cola">
                </div>
                <div class="related-content-container">
                    <div class="related-text-container">
                        <h3 class="related-text-title">malai-kofta</h3>
                        <p class="related-text">$99.99</p>
                    </div>
                    <div class="btn-container-related">
                        <a class="btn-main" href="#">See more</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- main -->

    <!-- footer -->
    <?php 
        include "./parts/footer.php";
    ?>
    <script src="./js/main.js"></script>
    <!-- footer -->
</body>

</html>