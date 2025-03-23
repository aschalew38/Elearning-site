<section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        @foreach($trainners as $trainner)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <img src="{{asset('Front/assets/img/trainers/trainer-1.jpg')}}" class="img-fluid" alt="">
            <div class="member-content">
              <h4>{{$trainner->name}}</h4>
              @foreach($trainner->courses as $course)
                
              <span class="badge badge-primary bg-primary text-white w-auto">{{$course->name}}</span>
              @endforeach
              <p>{{$trainner->overveiw}}  </p>
              
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
@endforeach
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <img src="{{asset('Front/assets/img/trainers/trainer-2.jpg')}}" class="img-fluid" alt="">
            <div class="member-content">
              <h4>Sarah Jhinson</h4>
              <span>Flutter</span>
              <p>
                Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <img src="{{asset('Front/assets/img/trainers/trainer-3.jpg')}}" class="img-fluid" alt="">
            <div class="member-content">
              <h4>William Anderson</h4>
              <span>Laravel</span>
              <p>
                Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>