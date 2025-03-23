@extends('Front.Layout.base')
@section('title', 'Events')
@section('content')
    <div style="margin-top: 10px;padding-left: 10px" class="mx-auto">


        <section id="trainers" class="trainers  roboto">
            <div class="container" data-aos="fade-up">
                <div class="row" data-aos="zoom-in" data-aos-delay="100">
                    @if ($events?->count() == 0)
                        <div class="col-lg-6 mx-auto mt-1">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h4 class="card-title">Events</h4>

                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-header-->
                                <div class="card-body">
                                    <div class="alert alert-outline-primary" role="alert">
                                        <strong>No EVents</strong>
                                    </div>

                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                    @endif


                    @foreach ($events as $event)
                        <div class="col-md-10
                         align-items-stretch">
                            <div class="member">
                                <div class="d-flex">

                                    <img src="{{ asset('storage/' . $event->poster) }}" class="col-md-4"
                                        {{-- height="200px" --}} alt="">
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
                                        <p class="text-left font-weight-bold" style="text-align: justify;font-weight: 700;color:black;"> <b>{{ $event->about }}</b></p>
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

    </div>

@endsection
