@extends('BackEnd.Layout.base')

@section('title', $blog->title)
@section("content")
{{-- <h1>{{ $blog->comments[0]->content }}</h1> --}}
{{-- @dd($blogs[2]->author); --}}
{{-- @dd("Dsd") --}}
<div class="row col-md-12 mx-auto my-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body gap-4">
                <div class="blog-card col-md-12 d-flex">
                    <div class="{{ $blog->gallery?->count()>0?'col-md-4':'col-md-11' }}">

                    <img src="{{asset('storage/'.$blog->cover)}}" alt="" class="img-fluid rounded" style="height: 200px;">
                    {{-- <span class="badge badge-purple px-3 py-2 bg-soft-primary fw-semibold mt-3">catagory</span>    --}}
                    <h4 class="my-3">
                        <p>{{$blog->title}}</p>
                    </h4>


                        <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <div class="meta-box">
                            <div class="media">
                                <div class="media-body align-self-center text-truncate">
                                    <ul class="p-0 list-inline mb-0">
                                        <li class="list-inline-item">published on: {{ Carbon\Carbon::parse($blog->created_at)->format('M  d , Y') }}</li>
                                    </ul>

                                </div>
                                <!--end media-body-->
                                <p class="px-2" style="text-align: justify;line-height: 2;font-weight: bold;">

                                    {{$blog->overview}}
                                    </p>
                            </div>
                        </div><!--end meta-box-->

                    </div>
                </div>

                <!--end blog-card-->
                @if($blog->gallery?->count()>0)
                <div class="card col-md-8">
                    <div class="card-header">
                        <p class="card-title">Gallery</p>
                    </div>
                    <!--end card-header-->
                    <div class="card-body col-md-12">
                        <div class="col-lg-12 text-center">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($blog->gallery as $ga)
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}"
                                            class="{{ $loop->index == 0 ? 'active' : '' }}">
                                        </li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($blog->gallery as $ga)
                                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $ga->path) }}" class="d-block h-46 w-100"
                                                alt="...">
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
               @endif
            </div>
            <div class="">

                <p style="text-align: justify;line-height: 2;">{{$blog->content}}</p>
            </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div>

    <hr style="height:1px;border:none;color:#333;background-color:#333;" class="my-4">
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
                                                action="{{ route('blog_comment.store', ['blog' => $blog, 'user' => Auth()->user()->id]) }}"
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

                                    <div class="">
                                        <div class="" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper"
                                                style="">
                                                <div class="" style="padding: 16px;">
                                                    <div class="chat-detail">
                                                        {{-- <h1> {{  $blog->comments}}</h1> --}}
                                                        @foreach ($blog->comments as $comment)
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
                                                                <div class=" mx-2">
                                                                    <div class="">
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
</div>


<div class="d-flex flex-row-reverse">

    <button onclick="history.back()" class="btn btn-primary">Go Back</button>
</div>

   <!--end col-->
</div>

@endsection
