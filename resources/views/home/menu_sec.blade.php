<section id="menu" class="menu section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Menu</h2>
        <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="menu-starters">
            <div class="row gy-5">

            @foreach($data as $data)
              <div class="col-lg-4 menu-item">
                <a href="assets/img/menu/menu-item-1.png" class="glightbox"><img src="food_img/{{$data->image}}" class="menu-img img-fluid" alt=""></a>
                <h4>{{$data->title}}</h4>
                <p class="ingredients">
                {{$data->detail}}
                </p>
                <p class="price">
                  {{$data->price}} Tk
                </p>
                <form action="{{url('add_cart',$data->id)}}" method="post">
                @csrf
                <input value="1" type="number" min="1" name="qty" required>
                <input class="btn btn-info" type="submit" value="Add To Cart" style="background-color: #D53535; color: white; border: 2px solid black;">
                </form>
              </div><!-- Menu Item -->
            @endforeach()
            </div>
            
          </div><!-- End Starter Menu Content -->
        </div>

      </div>

    </section><!-- /Menu Section -->