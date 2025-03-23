<div class="roboto col-md-10">
    {{-- <div class="container" data-aos="fade-up"> --}}
        <div  class="fade-in-container col-md-11 mx-auto d-flex justify-content-center"
        style="background: url('{{ asset('Front/assets/img/dss.jpg') }}')  top center;height:30vh">

              <h1 class="text-white">Digital Solutions</h1>
            </div>
          {{-- </div> --}}
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
            @if ($digitalsolutions?->count() == 0)
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    {{-- <h4 class="card-title">Digital Solution</h4> --}}

                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="alert alert-outline-primary" role="alert">
                                <strong>There is no Digital Solution!</strong>
                            </div>

                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
            @endif


            @foreach ($digitalsolutions as $digitalsolution)
                <div
                    class="col-md-11 d-flex flex-column gap-x-4 mx-auto
                      align-items-stretch shadow mt-2 mb-4">
                    <div class="align-items-start d-flex flex-row p-4">
                        <div class="d-flex justify-content-start col-md-4 px-2">
                            <img src="{{ asset('storage/' . $digitalsolution->poster) }}" class="col-12" alt="">
                        </div>
                        <div class="col-md-8 ">
                            <div class="d-flex justify-content-between mb-1">
                                <h4 class="text-left"> {{ $digitalsolution->title }}</h4>
                                <button class="btn btn-primary "
                                >{{ $digitalsolution->sector }}</button>
                            </div>
                            <p class="text-justify px-2" style="text-align: justify;line-height: 2">
                                {{ $digitalsolution->objective }}


                            </p>

                            <hr class="h-1">
                            <p class="text-end my-2"><small class="text-muted">Published:
                                    {{ $digitalsolution->created_at->diffForHumans() }}</small></p>
                                    <a href="{{ route('digitalSolutions.show', ['digitalSolution' => $digitalsolution->id]) }}"
                            class="text-primary btn btn-primary text-white mx-4">Detail  ...</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    {{-- </div> --}}

    </div>
