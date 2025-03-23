@extends("Front.Layout.base")
@section("title",$blog->title)
@section("content")
{{-- @dd($blogs[2]->author); --}}
<div class="row col-md-10 mx-auto my-4  container-fluid">

<div class="col-md-12">
        <div class="card">
            <div class="card-body d-flex gap-4">
                <div class="blog-card col-md-4">
                    <img src="{{asset('storage/'.$blog->cover)}}"
                    alt="" class="img-fluid rounded">

                </div><!--end blog-card-->

            <div class="">
                <h3 class="my-3 text-success " style="text-align: justify">{{$blog->title}}</h3>

                <p class="text-muted" style="text-align: justify;line-height: 2;font-size:1.1rem">

                    {{$blog->overview}}
                    </p>
                    {{-- <hr> --}}
                <p style="text-align: justify;line-height: 2.5" class="px-2">{{$blog->content}}</p>
            </div>
            </div><!--end card-body-->
        {{-- </div><!--end card--> --}}
    {{-- </div> --}}
    <hr style="height:1px;border:none;color:#333;background-color:#333;" class="my-4">
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
    </div>
</div>
   <!--end col-->
</div>

@endsection
