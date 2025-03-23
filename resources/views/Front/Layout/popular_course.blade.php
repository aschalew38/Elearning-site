<section id="popular-courses" class="courses">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Courses</h2>
            <p>Popular Courses</p>
        </div>
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            @if ($courses?->count() == 0)
            @else
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch my-1 h-auto">
                        <div class="course-item">
                            {{ $course->cover }}
                            <img src="{{ asset('storage/' . $course->poster) }}" height="200px" class="col-12"
                                alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4><a href="{{ route('course.show',['course'=>$course->id]) }}" class="text-white">{{  $course->name }}</a></h4>
                                    {{-- <p class="price">{{ $course->price }}ETB</p> --}}
                                </div>
                                <h3><a href="#">{{ $course->catagory }}
                                    </a></h3>
                                @php
                                    $desc = $course->overview;
                                    if (strlen($course->overview) > 1000) {
                                        $desc = substr($course->overview, 1000) . '  ...';
                                    }
                                    // strlen($course->catagory);
                                @endphp

                                <p class="text-justify w-11/12" style="text-align: justify">{{ $desc }}</p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        {{-- @if ($course?->owner()?->profile)
                                            <img src="{{ asset('storage/' . $course?->owner()?->profile) }}"
                                                height="50px" width="50px" alt="">
                                        @else --}}
                                            {{-- <img src="{{ asset('Front/assets/img/trainers/trainer-2.jpg') }}"
                                                                                height="50px" width="50px" alt=""> --}}
                                            {{-- <i class="fa fa-user"></i> --}}
                                        {{-- @endif --}}

                                        {{-- <span>{{ $course?->owner()?->name }}</span> --}}
                                    </div>
                                    <div class="trainer-rank d-flex align-items-center">
                                        <i class="bx bx-user"></i>&nbsp;{{ $course->enrolled_students()?->count() }}
                                        &nbsp;&nbsp;
                                        <i class="bx bx-heart"></i>&nbsp;{{ $course->likes() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="px-5 py-2 d-flex justify-content-end">
                    @if (method_exists($courses, 'links'))
                        {{ $courses->links() }}
                    @endif
                </div>
            @endif

</section>
