<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== FAVICON ===============-->
      <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

      <!--=============== SWIPER CSS ===============-->
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="assets/css/styles.css">

      <title>STARCOFFEE</title>
   </head>
   <body>
      <!--==================== HEADER ====================-->
      <header class="header" id="header">
         <nav class="nav container">
            <a href="#" class="nav--logo">STARCOFFEE</a>

            <div class="nav--menu" id="nav-menu">
               <ul class="nav--list">
                  <li>
                     <a href="#home" class="nav--link active-link">HOME</a>
                  </li>

                  <li>
                     <a href="#popular" class="nav--link">POPULAR</a>
                  </li>

                  <li>
                     <a href="#about" class="nav--link">ABOUT US</a>
                  </li>

                  <li>
                     <a href="#products" class="nav--link">PRODUCTS</a>
                  </li>

                  <li>
                     <a href="#contact" class="nav--link">CONTACT</a>
                  </li>
               </ul>

               <!--close button-->
               <div class="nav--close" id="nav-close">
                  <i class="ri-close-large-line"></i>
               </div>
            </div>

            <!--toggle button-->
            <div class="nav--toggle" id="nav-toggle">
               <i class="ri-apps-2-fill"></i>
            </div>
         </nav>
      </header>

      <!--==================== MAIN ====================-->
      <main class="main">
         <!--==================== HOME ====================-->
         <section class="home section" id="home">
            <div class="home--container container grid">
               <h1 class="home--title">COLD COFFEE</h1>

               <div class="home--images">
                  <div class="home--shape"></div>
                  <img src="assets/img/home-splash.png" alt="image" class="home--splash">
                  <img src="assets/img/bean-img.png" alt="image" class="home--bean-2">
                  <img src="assets/img/home-coffee.png" alt="image" class="home--coffee">
                  <img src="assets/img/bean-img.png" alt="image" class="home--bean-1">
                  <img src="assets/img/ice-img.png" alt="image" class="home--ice-1">
                  <img src="assets/img/ice-img.png" alt="image" class="home--ice-2">
                  <img src="assets/img/leaf-img.png" alt="image" class="home--leaf">
               </div>

               <img src="assets/img/home-sticker.svg" alt="image" class="home--sticker">

               <div class="home--data">
                  <p class="home--description">
                     Find delicious hot and cold coffees with the 
                     best varieties, calm the pleasure and enjoy 
                     a good coffee, order now.
                  </p>

                  <a href="#about" class="button">Learn More</a>
               </div>
            </div>
         </section>

         <!--==================== POPULAR ====================-->
         <section class="popular section" id="popular">
            <div class="popular__container container">
               <h2 class="section__title">POPULAR <br> CREATIONS</h2>

               <div class="popular__swiper swiper">
                  <div class="swiper-wrapper">
                     <article class="popular__card swiper-slide">
                        <div class="popular__images">
                           <div class="popular__shape"></div>
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-1">
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-2">
                           <img src="assets/img/popular-coffee-1.png" alt="image" class="popular__coffee">
                        </div>

                        <div class="popular__data">
                           <h2 class="popular__name">VANILLA LATTE</h2>

                           <p class="popular__description">
                              Indulge in the simplicity of our delicious cold brew coffee.
                           </p>

                           <a href="order.php?product=VANILLA LATTE&price=89.90" class="button button-dark">Order now: ₱89.90</a>

                        </div>
                     </article>

                     <article class="popular__card swiper-slide">
                        <div class="popular__images">
                           <div class="popular__shape"></div>
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-1">
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-2">
                           <img src="assets/img/popular-coffee-2.png" alt="image" class="popular__coffee">
                        </div>

                        <div class="popular__data">
                           <h2 class="popular__name">CLASSIC COFFEE</h2>

                           <p class="popular__description">
                              Indulge in the simplicity of our delicious cold brew coffee.
                           </p>

                           <a href="order.php?product=CLASSIC COFFEE&price=69.90" class="button button-dark">Order now: ₱69.90</a>

                        </div>
                     </article>

                     <article class="popular__card swiper-slide">
                        <div class="popular__images">
                           <div class="popular__shape"></div>
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-1">
                           <img src="assets/img/bean-img.png" alt="image" class="popular__bean-2">
                           <img src="assets/img/popular-coffee-3.png" alt="image" class="popular__coffee">
                        </div>

                        <div class="popular__data">
                           <h2 class="popular__name">MOCHA COFFEE</h2>

                           <p class="popular__description">
                              Indulge in the simplicity of our delicious cold brew coffee.
                           </p>

                           <a href="order.php?product=MOCHA COFFEE&price=109.90" class="button button-dark">Order now: ₱109.90</a>

                        </div>
                     </article>
                  </div>
               </div>
            </div>
         </section>

         <!--==================== ABOUT ====================-->
         <section class="about section" id="about">
            <div class="about__container container grid">
              <div class="about__data">
               <h2 class="section__title">LEARN MORE <br> ABOUT US</h2>

               <p class="about__description">
                  Welcome to StarCoffee, where coffee is pure passion. 
                  From bean to cup, we are dedicated to delivering 
                  excellence in every sip. Join us on a journey of 
                  flavor and quality, crafted with love to create the 
                  ultimate coffee experience.
               </p>

               <a href="#popular" class="button">The Best Coffees</a>
              </div>
              
              <div class="about__images">
                  <div class="about__shape"></div>
                  <img src="assets/img/leaf-img.png" alt="image" class="about__leaf-1">
                  <img src="assets/img/leaf-img.png" alt="image" class="about__leaf-2">
                  <img src="assets/img/about-coffee.png" alt="image" class="about__coffee">
              </div>
            </div>
         </section>

         <!--==================== PRODUCTS ====================-->
         <section class="products section" id="products">
            <h2 class="section__title">THE MOST <br> REQUESTED</h2>

            <div class="products__container container grid">
               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-1.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">ICED COFFEE MOCHA</h3>

                     <span class="products__price">₱49.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=ICED COFFEE MOCHA&price=49.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                  </div>
               </article>

               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-2.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">COFFEE WITH CREAM</h3>

                     <span class="products__price">₱59.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=COFFEE WITH CREAM&price=59.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                  </div>
               </article>

               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-3.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">CAPPUCCINO COFFEE</h3>

                     <span class="products__price">₱69.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=CAPPUCCINO COFFEE&price=69.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                  </div>
               </article>

               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-4.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">COFFEE WITH MILK</h3>

                     <span class="products__price">₱79.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=COFFEE WITH MILK&price=79.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                     </a>
                  </div>
               </article>

               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-5.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">CLASSIC ICED COFFEE</h3>

                     <span class="products__price">₱89.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=CLASSIC ICED COFFEE&price=89.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                  </div>
               </article>

               <article class="products__card">
                  <div class="products__images">
                     <div class="products__shape"></div>
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-1">
                     <img src="assets/img/ice-img.png" alt="image" class="products__ice-2">
                     <img src="assets/img/products-coffee-6.png" alt="image" class="products__coffee">
                  </div>

                  <div class="products__data">
                     <h3 class="products__name">ICED COFFEE FRAPPE</h3>

                     <span class="products__price">₱99.90</span>

                     <button class="products__button" onclick="location.href='order.php?product=ICED COFFEE FRAPPE&price=99.90'">
   <i class="ri-shopping-bag-3-fill"></i>
</button>
                  </div>
               </article>
            </div>
         </section>

         <!--==================== CONTACT ====================-->
         <section class="contact section" id="contact">
            <h2 class="section__title">CONTACT US</h2>

            <div class="contact__container container grid">
               <div class="contact__info grid">
                  <div>
                     <h3 class="contact__title">Write Us</h3>

                     <div class="contact__social">
                        <a href="" target="_blank" class="contact__social-link">
                           <i class="ri-whatsapp-fill"></i>
                        </a>

                        <a href="" target="_blank" class="contact__social-link">
                           <i class="ri-messenger-fill"></i>
                        </a>

                        <a href="" target="_blank" class="contact__social-link">
                           <i class="ri-telegram-2-fill"></i>
                        </a>
                     </div>
                  </div>

                  <div>
                     <h3 class="contact__title">Location</h3>

                     <address class="contact__address">
                        Bohol, Tagbilaran City <br>
                        Dao 6300
                     </address>

                      <a href="https://maps.app.goo.gl/mf8Yo8eMGwfNk1eq8" class="contact__map">
                        <i class="ri-map-pin-fill"></i>
                        <span>View On Map</span>
                      </a>
                  </div>
               </div>

               <div class="contact__info grid">
                  <div>
                     <h3 class="contact__title">Delivery</h3>

                     <address class="contact__address">
                        +639155897101 <br>
                        +639684355812
                     </address>
                  </div>

               <div>
                  <h3 class="contact__title">Attention</h3>
                  Monday - Saturday <br>
                  9AM - 10PM
                  <address class="contact__address">
                     
                  </address>
               </div>
            </div>

               <div class="contact__images">
                  <div class="contact__shape"></div>
                  <img src="assets/img/contact-delivery.png" alt="image" class="contact__delivery">
               </div>
            </div>
         </section>
      </main>

      <!--==================== FOOTER ====================-->
      <footer class="footer">
         <div class="footer__container container grid">
            <div>
               <h3 class="footer__title">Social</h3>

               <div class="footer__social">
                  <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                     <i class="ri-facebook-circle-fill"></i>
                  </a>

                  <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                     <i class="ri-instagram-fill"></i>
                  </a>

                  <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                     <i class="ri-twitter-x-line"></i>
                  </a>
               </div>
            </div>

            <div>
               <h3 class="footer__title">Payment Methods</h3>

               <div class="footer__pay">
                  <img src="assets/img/footer-card-1.png" alt="image" class="footer__pay-card">
                  <img src="assets/img/footer-card-2.png" alt="image" class="footer__pay-card">
                  <img src="assets/img/footer-card-3.png" alt="image" class="footer__pay-card">
                  <img src="assets/img/footer-card-4.png" alt="image" class="footer__pay-card">
               </div>
            </div>

            <div>
               <h3 class="footer__title">Subscribe For Discounts</h3>

               <form action="" class="footer__form">
                  <input type="email" placeholder="Email" class="footer__input">
                  <button type="submit" class="footer__button button">Subscribe</button>
               </form>
            </div>
         </div>

         <span class="footer__copy">
            &#169; All Rights Reserved By Group6
         </span>
      </footer>

      <!--========== SCROLL UP ==========-->
      <a href="#" class="scrollup" id="scroll-up">
         <i class="ri-arrow-up-line"></i>
      </a>

      <!--=============== SCROLLREVEAL ===============-->
      <script src="assets/js/scrollreveal.min.js"></script>

      <!--=============== SWIPER JS ===============-->
      <script src="assets/js/swiper-bundle.min.js"></script>

      <!--=============== MAIN JS ===============-->
      <script src="assets/js/main.js"></script>
   </body>
</html>