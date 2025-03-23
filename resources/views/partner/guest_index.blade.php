@extends('Front.Layout.base')
@section('title', 'Partners')
@section('content')

    <div class="card col-11 mx-auto my-1">
        <div class="card-header">
            <h6 class="card-title">Partners</h6>
            <div class="col border-1">
                <div class="img-group d-flex flex-row justify-content-between">
                    @foreach ($partners as $partner)
                        <a class="user-avatar me-1 " href="{{ $partner->url }}">
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="user" class="rounded-circle thumb-lg shadow"
                                style="width: 70px;height: 70px;">
                            <span class="avatar-badge online"></span>
                        </a>
                    @endforeach

                </div><!--end img-group-->
            </div>

        </div><!--end card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2 px-0" style="">
                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($office_types as $type)
                            <a class="nav-link waves-effect waves-light px-2 my-1 {{ $loop->index == 0 ? 'active' : '' }}"
                                style="font-size:24px;text-align:left;vertical-align: middle;
                            /* background-color: rgb(89, 89, 212) */
                            "
                                id="{{ $type->id }}_tab" data-bs-toggle="pill"
                                href="{{ route('partner.index') }}#{{ $type->id }}" role="tab"
                                aria-controls="v-pills-home" aria-selected="false">{{ $type->name }}</a>
                            {{-- <hr class="text-white"> --}}
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="tab-content mo-mt-2" id="v-pills-tabContent">
                        @foreach ($office_types as $type)
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}" id="{{ $type->id }}"
                                role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="card">
                                    <div class="px-4 bg-primary text-white">
                                        <h4 class="card-title">{{ $type->name }} Partners</h4>
                                    </div><!--end card-header-->
                                    <div class="card-body">
                                        <div class="accordion" id="accordionExample">

                                            @foreach ($type->partners->sortByDesc('created_at') as $partner)
                                                <div class="accordion-item">
                                                    <p class="accordion-header m-0" id="headingOne">
                                                        <button class="accordion-button fw-semibold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#{{ $partner->id }}_part"
                                                            aria-expanded="false" aria-controls="collapseOne">
                                                            {{ $partner->name }}
                                                        </button>
                                                    </p>
                                                    <div id="{{ $partner->id }}_part" class="accordion-collapse collapse"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample"
                                                        style="">
                                                        <div class="accordion-body">
                                                            <div class="d-flex flex-row">
                                                                <div class="col-md-3 mx-2">
                                                                    <img src="{{ asset('storage/' . $partner->logo) }}"
                                                                        alt="" class="img-fluid rounded">

                                                                </div>
                                                                <div>

                                                                    @if ($partner->objective)
                                                                        <strong>Objective .</strong>
                                                                        <p style="text-align: justify; line-height: 1.5">
                                                                            {{ $partner->objective }}</p>
                                                                    @endif
                                                                    @if ($partner->success)
                                                                        <strong>Success </strong>
                                                                        <p style="text-align: justify; line-height: 1.5">
                                                                            {{ $partner->success }}</p>
                                                                    @endif
                                                                    @if ($partner->description)
                                                                        <strong>Description .</strong>
                                                                        <p style="text-align: justify; line-height: 1.6">
                                                                            {{ $partner->description }}</p>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row py-2" style="">
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="contact-info-item contact-info-item--bordered text-center">
                                                                        <div class="justify-content-center">
                                                                            <div class="block">

                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24"
                                                                                viewBox="0 0 24 24"
                                                                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>

                                                                                </div>
                                                                                {{-- <br> --}}
                                                                            <div>

                                                                                <a href="{{$partner->url }}" target="_blank" class="txt-primary">{{ $partner->name }}</a>
                                                                            </div>
                                                                        </div>

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-phone">
                                                                            <path
                                                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                                                            </path>
                                                                        </svg>
                                                                        <div class="contact-info-item__text">
                                                                            {{ $partner->phone }}</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div
                                                                        class="contact-info-item contact-info-item--bordered text-center">
                                                                        <div class="contact-info-item__icon">
                                                                            <i
                                                                                class="fa fa-location-arrow"></i></div>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-map icon-dual">
                                                                            <polygon
                                                                                points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6">
                                                                            </polygon>
                                                                            <line x1="8" y1="2"
                                                                                x2="8" y2="18"></line>
                                                                            <line x1="16" y1="6"
                                                                                x2="16" y2="22"></line>
                                                                        </svg>
                                                                        {{-- {{ $partner->locs() }} --}}
                                                                        {{-- {!! $partner->locs() !!} --}}
                                                                        @foreach ($partner->locs() as $loc)
                                                                            <p>{{ $loc }}</p>
                                                                        @endforeach
                                                                        {{-- <div class="contact-info-item__text">1234 Sudan Streat <br> Addis Ababa, Ethiopia</div> --}}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="contact-info-item text-center">
                                                                        {{-- <div class="contact-info-item__icon"><i class="fa fa-envelope-square"></i></div> --}}
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-mail icon-dual">
                                                                            <path
                                                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                                            </path>
                                                                            <polyline points="22,6 12,13 2,6"></polyline>
                                                                        </svg>
                                                                        <div class="contact-info-item__text">
                                                                            {{ $partner->email }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="mt-1 text-white px-4 pt-1">

                                                            </div> --}}

                                                        </div>
                                                    </div>



                                                </div>
                                            @endforeach


                                        </div>
                                    </div><!--end card-body-->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!--end card-body-->
    </div>
@endsection
