@extends('BackEnd.Layout.base')
@section('title', $partner->name)
@section('content')
    <div class="col-lg-12 mx-auto mt-4">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-12 bg-light-alt p-2 d-flex flex-row gap-2">
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="..." class="col-md-4" style="max-height:300px;width:300px">
                    <div class="p-4">

                        @if ($partner->description)
                            {{-- <hr class="dashed"> --}}
                            <p class="card-text mb-0 text-justify" style="text-align: justify; line-height: 2;font-size:1rem">
                                <strong>Description </strong>
                                {{ $partner->description }}
                            </p>
                            @if ($partner->objective)
                                <hr>

                                <p class="card-text mb-0 text-justify"
                                    style="text-align: justify; line-height: 2;font-size:1.1rem">
                                    <strong>Objective </strong>
                                    {{ $partner->objective }}
                                </p>
                            @endif
                        @endif
                        @if ($partner->success)
                        <hr class="dashed">
                        <p class="card-text mb-0 text-justify"
                            style="text-align: justify; line-height: 2;font-size:1rem">
                            <strong>Success </strong>
                            {{ $partner->success }}
                        </p>
                    @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ $partner->name }}

                            <span class="badge bg-primary mx-4">{{ $partner->organization_type?->name }}</span>
                        </h5>




                        <hr class="dashed my-2" />
                        <div class="chat-body " style="width: 100%;" data-simplebar="init">
                            <div class="simplebar-wrapper" style="width:100%";background-color:red;>
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper"
                                            style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 16px;">
                                                <div class="chat-detail">
                                                    {{-- @foreach ($comments as $comment) --}}
                                                    <div class="d-flex flex-row align-items-middle mb-2">

                                                        <div class="media-body">
                                                            <div class="chat-msg">
                                                                <p style="text-align: justify;padding-right:2px;"
                                                                    class="pr-4">{{ $partner->success }}</p>
                                                            </div>

                                                        </div><!--end media-body-->
                                                    </div>
                                                    <hr>
                                                    <div class="row py-2" style="">
                                                        <div class="col-sm-4">
                                                            <div
                                                                class="contact-info-item contact-info-item--bordered text-center">
                                                                <div class="justify-content-center">
                                                                    <div class="block">

                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            class="feather feather-globe">
                                                                            <circle cx="12" cy="12" r="10">
                                                                            </circle>
                                                                            <line x1="2" y1="12"
                                                                                x2="22" y2="12"></line>
                                                                            <path
                                                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                                            </path>
                                                                        </svg>

                                                                    </div>
                                                                    {{-- <br> --}}
                                                                    <div>

                                                                        <a href="{{ $partner->url }}" target="_blank"
                                                                            class="txt-primary">{{ $partner->name }}</a>
                                                                    </div>
                                                                </div>

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
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
                                                                    {{-- <i                                                   class="fa fa-location-arrow"></i></div> --}}
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-map icon-dual">
                                                                        <polygon
                                                                            points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6">
                                                                        </polygon>
                                                                        <line x1="8" y1="2" x2="8"
                                                                            y2="18"></line>
                                                                        <line x1="16" y1="6" x2="16"
                                                                            y2="22"></line>
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
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
                                                    </div> <!-- end chat-detail -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 735px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 457px; transform: translate3d(0px, 122px, 0px); display: block;">
                                    </div>
                                </div>
                            </div><!-- end chat-body -->
                            <!-- end chat-footer -->
                        </div>




                        <button onclick="history.back()" class="btn btn-primary">Go Back</button>


                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->

    </div>

@endsection
