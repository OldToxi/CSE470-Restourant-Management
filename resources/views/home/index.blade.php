<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
</head>

<body class="index-page">

  @include('home.header')

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
          <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Enjoy Your Healthy<br>Delicious Food</h1>
            <p data-aos="fade-up" data-aos-delay="100">We are team of talented designers making websites with Bootstrap</p>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    @include('home.about')

    <!-- Why Us Section -->
    @include('home.why_us')

    <!-- Stats Section -->
    @include('home.stats')

    <!-- Menu Section -->
    @include('home.menu_sec')

    <!-- Testimonials Section -->
    @include('home.testim')

    <!-- Events Section -->
    @include('home.event')

    <!-- Chefs Section -->
    @include('home.chef')

    <!-- Book A Table Section -->
    @include('home.booking')

    <!-- Gallery Section -->
    @include('home.gallery')

    <!-- Contact Section -->
    @include('home.contact')

  </main>

  @include('home.footer')

</body>

</html>