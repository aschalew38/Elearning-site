@extends('Front.Layout.base')
@section('title', 'Digital Solutions')
@section('content')
    @include('Front.Layout.blogs')

    <section id="trainers" class="trainers  roboto">
        <div class="container" data-aos="fade-up">
            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach ($events as $event)
                    <div class="col-md-10
 align-items-stretch">
                        <div class="member">
                            <div class="d-flex">

                                <img src="{{ asset('storage/' . $event->poster) }}" class="col-md-4" {{-- height="200px" --}}
                                    alt="">
                                <div class="col-md-8 px-4">
                                    <h5 class="my-4 d-flex align-items-end">From
                                        <span class="mx-2 text-primary">
                                            <a type="button" class="btn btn-primary btn-sm">
                                                {{ \Carbon\Carbon::parse($event->starting_date)->format('d, M Y') }}
                                                {{-- </span> --}}
                                            </a>
                                            to
                                            <a type="button" class="btn btn-primary btn-sm">
                                                {{ \Carbon\Carbon::parse($event->ending_date)->format('d, M Y') }}
                                            </a>
                                    </h5>
                                    <hr>
                                    <p class="text-left font-weight-bold"
                                        style="text-align: justify;font-weight: 700;color:black;">
                                        <b>{{ $event->about }}</b>
                                    </p>
                                    <p class="text-justify px-2" style="text-align: justify">
                                        {{ $event->body }}

                                    </p>

                                    <p class="text-end my-2"><small class="text-muted">Published:
                                            {{ $event->created_at->diffForHumans() }}</small></p>
                                </div>
                                {{-- {{ $event }} --}}
                            </div>

                            <div class="member-content">
                                <div class="d-flex justify-content-between">

                                    <span class="badge bg-primary">{{ $event->type }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="popular-courses" class="courses">
        <div class="container" data-aos="fade-up">

            {{-- <div class="section-title">
            <h2>Courses</h2>
            <p>Popular Courses</p>
        </div> --}}

            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch my-1 h-auto">
                        <div class="course-item">
                            {{ $course->cover }}
                            <img src="{{ asset('storage/' . $course->poster) }}" height="200px" class="col-12"
                                alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4><a href="{{ route('course.show', ['course' => $course->id]) }}"
                                            class="text-white">{{ $course->name }}</a></h4>
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

                                <p class="text-justify w-11/12" style="text-align: justify">{{ $desc }}
                                </p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        @if ($course?->owner()?->profile)
                                            <img src="{{ asset('storage/' . $course?->owner()?->profile) }}" height="50px"
                                                width="50px" alt="">
                                        @else
                                            {{-- <img src="{{ asset('Front/assets/img/trainers/trainer-2.jpg') }}"
                                                            height="50px" width="50px" alt=""> --}}
                                            <i class="fa fa-user"></i>
                                        @endif

                                        <span>{{ $course?->owner()?->name }}</span>
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
    </section>
    <div style="padding-left: 10px" class="col-md-12 row min-vh-100 d-flex flex-row">
        @include('Front.Layout.ds')
        <div class="card col col-md-2 h-25 p-2">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                    Sectors
                </a>
                @foreach ($catagories as $catagory)
                    <a href="{{ route('ds.search', ['sector' => $catagory->sector]) }}"
                        class="list-group-item list-group-item-action">{{ $catagory->sector }}</a>
                @endforeach
            </div>
        </div>
    </div>

@endsection
