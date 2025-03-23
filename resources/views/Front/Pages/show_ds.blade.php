@extends('Front.Layout.base')
@section('title', $digitalSolution->title)

@section('content')
    <div class="col-lg-10 mx-auto mt-4 d-flex flex-row">
        <div class="card col-md-9 mb-3">
            <div class="row g-0">
                <div class="col-md-12 bg-light-alt p-2 d-flex flex-row gap-2">
                    <img src="{{ asset('storage/' . $digitalSolution->poster) }}" alt="..." class="img-fluid col-md-4">
                    <div class="col-md-8 px-4 py-2">

                        <h5 class="card-title px-4">{{ $digitalSolution->title }}</h5>
                        <!--end card-->
                        <hr>
                        <p class="card-text mb-0 text-justify px-4"
                            style="text-align: justify; line-height: 2;font-size:1.1rem">

                            {{ $digitalSolution->objective }}
                        </p>
                        @if($digitalSolution ->url)
                        <div class="px-4">

                            <a href="{{ $digitalSolution ->url }}" class="m-4 px-4" target="_blank"><h5 class="text-primary">Visit Website</h5></a>
                        </div>
                        @endif
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-12">
                    <div class="card-body">
                        <hr class="dashed">
                        <p class="card-text mb-0 text-justify" style="text-align: justify; line-height: 2;font-size:1rem">
                            {{ $digitalSolution->detail }}</p>
                        {{-- </p> --}}
                        {{-- {{ $digitalSolution->gallery }} --}}
                        <p class="card-text my-2"><small class="text-primary">Published on
                                {{ $digitalSolution->created_at }}</small></p>

                        <hr class="dashed my-2" />
                        <div class="">
                            <div class="bg-primary">
                                <p class="text-white px-4 py-4 rounded">Gallery</p>
                            </div>
                            <!--end card-header-->
                            <div class="card-body col-md-12">
                                <div class="col-lg-12 text-center">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($digitalSolution->gallery as $ga)
                                                <li data-bs-target="#carouselExampleIndicators"
                                                    data-bs-slide-to="{{ $loop->index }}"
                                                    class="{{ $loop->index == 0 ? 'active' : '' }}">
                                                </li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($digitalSolution->gallery as $ga)
                                                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $ga->path) }}"
                                                        class="d-block h-46 w-100" alt="...">
                                                </div>
                                            @endforeach

                                        </div>
                                        <a class="carousel-control-prev" href="ui-carousels.html#carouselExampleIndicators"
                                            role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="ui-carousels.html#carouselExampleIndicators"
                                            role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <!--end card-body-->
                        </div>
                        <div class="" style="width: 100%;margin-left:0px;">
                            <!-- end chat-header -->
                            <div class="chat-header">
                                <div class="row">
                                    <div class="col-12 col-md-11">
                                        <span class="h-1 w-1 rounded">
                                            {{-- <img src="assets/images/users/user-8.jpg" alt="user" class="rounded-circle thumb-sm"> --}}
                                            @if (Auth::user()?->profile)
                                                <img src="{{ asset('storage/' . Auth::user()->profile) }}"
                                                    style="width: 50px;height: 50px;;" alt="profile-user"
                                                    class="rounded-circle" />
                                            @else
                                                <i class="fa fa-user"></i>
                                            @endif
                                            {{ Auth::user()?->name }}
                                        </span>
                                        @if (Auth::user())
                                            <form
                                                action="{{ route('comment.store', ['DigitalSolution' => $digitalSolution, 'user' => Auth()->user()->id]) }}"
                                                method="POST">
                                                @csrf
                                                <textarea id="textarea" class="form-control mt-2" name="content" rows="3"
                                                    placeholder="Provide your comments here"></textarea>
                                                {{-- <button type="submit">ok</button> --}}
                                                <div class="d-flex flex-row-reverse mt-1">

                                                    <button type="submit"
                                                        class="btn btn-primary btn-round  ml-auto">Comments</button>
                                                </div>
                                            </form>
                                        @endif
                                        {{-- <input type="text" class="form-control" placeholder="Type something here..."> --}}
                                    </div><!-- col-8 -->
                                    <!-- end col -->
                                </div><!-- end row -->
                            </div>
                            <div class="" style="width: 100%;" data-simplebar="init">
                                {{-- <div class="simplebar-wrapper" style="width:100%";background-color:red;> --}}

                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper"
                                                style="">
                                                <div class="simplebar-content" style="padding: 16px;">
                                                    <div class="chat-detail">
                                                        @foreach ($digitalSolution->comments as $comment)
                                                            <div class="d-flex flex-row align-items-middle mb-2">
                                                                <div class="media-img p-2 rounded">
                                                                    {{-- <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle thumb-md"> --}}
                                                                    {{-- {{ $comment->user }} --}}
                                                                    @if ($comment->user?->profile)
                                                                        <img src="{{ asset('storage/' . $comment->user?->profile) }}"
                                                                            style="width:50px;height: 50px;"
                                                                            alt="profile-user"
                                                                            class="rounded-circle thumb-xs" />
                                                                    @else
                                                                        <i class="fa fa-user"></i>
                                                                    @endif


                                                                </div>
                                                                <div class="media-body mx-2">
                                                                    <div class="chat-msg">
                                                                        <b>{{ $comment->user?->name }}</b>
                                                                        <p style="text-align: justify;padding-right:2px;"
                                                                            class="pr-4">{{ $comment->content }}</p>
                                                                    </div>

                                                                    <div class="chat-time"><span
                                                                            class="text-primary">{{ \Carbon\Carbon::parse($comment->created_at) }}</span>
                                                                    </div>
                                                                </div><!--end media-body-->
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                        <!--end media-->

                                                        <!--end media-->
                                                    </div> <!-- end chat-detail -->
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                    {{-- <div class="simplebar-placeholder" style="width: auto;"></div> --}}
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
        {{-- <div class=""> --}}
            <div class="col-md-5 col-xl-4 mx-1">
                <div class="col-md-12 col-xl-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            <p class="card-title">Focus Area</p>
                        </div>
                        <div class="card-body">
                                <p class="card-subtitle font-14 mb-2 text-justify" style="text-align: justify">
                                    {{ $digitalSolution->focus_area }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            <p class="card-title">Target Group</p>
                        </div>
                        <div class="card-body">
                               <ol>

                               @foreach($target_groups as $tr)
                                <li>{{$tr->name}}</li>
                               @endforeach
                               </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            <p class="card-title">Geographical Scope</p>
                        </div>
                        <div class="card-body">
                               <ol>

                               @foreach($coverage_areas as $tr)
                                <li>{{$tr->name}}</li>
                               @endforeach
                               </ol>
                        </div>
                    </div>
                </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                        <p class="card-title">Sponsors</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom-dashed mb-1">
                                    @foreach($partner_implementor as $sponsor)

                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('storage/'.$sponsor->logo) }}" height="40" width="40"
                                            class="me-3 align-self-center rounded-circle" alt="...">
                                        <div class=" align-self-center">
                                        <a href="{{$sponsor->url}}">
                                            <p class="mt-0 mb-1 text-primary">{{$sponsor->name}}</p>
                                            </a>
                                        </div>

                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    {{-- <div class="col"> --}}
                                        <p class="card-title">Implementing partner </p>
                                    {{-- </div> --}}
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="border-bottom-dashed mb-4">
                                    @foreach($partner_implementor as $imp)

                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('storage/'.$imp->logo) }}" height="40" width="40"
                                            class="me-3 align-self-center rounded-circle" alt="...">
                                        <div class=" align-self-center">
                                        <a href="{{$imp->url}}">
                                            <p class="mt-0 mb-1 text-primary">{{$imp->name}}</p>
                                            </a>
                                        </div>

                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    {{-- <div class="col"> --}}
                                        <p class="card-title">Lead organization </p>
                                    {{-- </div> --}}
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="border-bottom-dashed mb-4">
                                    @foreach($partner_lead as $imp)
                                    <div class="d-flex mb-3">
                                        <img src="{{ asset('storage/'.$imp->logo) }}" height="40" width="40"
                                            class="me-3 align-self-center rounded-circle" alt="...">
                                        <div class=" align-self-center">
                                        <a href="{{$imp->url}}">
                                            <p class="mt-0 mb-1 text-primary">{{$imp->name}}</p>
                                            </a>
                                        </div>

                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        {{-- </div> --}}
        <!--end card-->

    </div>


@endsection
