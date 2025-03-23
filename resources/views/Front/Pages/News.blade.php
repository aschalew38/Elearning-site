@extends("Front.Layout.base")
@section("title","Digital Solutions")
@section("content")
<div class="d-flex justify-content-end">
    @if($current_news)
    <div class="col-lg-6 mx-4 my-4">
        <div class="card">
            <div class="card-body">
                <div class="blog-card align-items-center flex-col">
                    <h4 class="my-1">
                        <a href="" class="">{{$current_news?->title}}</a>
                    </h4>
                    <span class="badge badge-purple px-3 py-2 bg-primary  fw-semibold my-2 ">
                        {{ $current_news?->created_at->diffForHumans() }}
                    </span>
                    <br>
                    <img src="{{ asset('storage/' . $current_news?->poster) }}" alt="" class="img-fluid rounded" />
                    <br>
                    <p class="text-muted">{{ $current_news?->headline }}</p>

                    <span class="badge badge-purple px-3 p1-2 bg-soft-primary  text-primary fw-semibold mt-1">
                        Posted By:<span class="mx-4">{{ $current_news?->postedBy()?->username }}</span>
                    </span>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <div class="meta-box">
                            <div class="media">
                                <p class="" style="text-align: justify">{{ $current_news?->body }}</p>
                            </div><!--end media-body-->
                        </div>
                    </div><!--end meta-box-->

                </div>
            </div><!--end blog-card-->

        </div><!--end card-body-->
    </div>
@endif
    <div class="col-md-4">
        <div class="row mt-4">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title text-success">News</h4>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">

                                    @if ($news?->count() == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">No records Found</td>
                                        </tr>
                                    @else
                                    <ul class="list-group">
                                        @foreach ($news as $nw)

                                             <li class="list-group-item {{$current_news?->id==$nw?->id?"active":""}}">

                                                <a href="{{route('new',['id'=>$nw?->id])}}"
                                                    class="media d-flex {{$current_news?->id==$nw?->id?"text-white":""}}">
                                                    <img class="d-flex me-3 rounded-circle" style="width: 40px;height:40px"
                                                    src="{{ asset('storage/' . $nw?->poster) }}"
                                                    alt="news poster">
                                                     <div class="media-body chat-user-box">
                                                        <p class="user-title mb-1 {{$current_news?->id==$nw->id?"text-white":""}}">
                                                            <?php
                                                                // $title=strlen($nw?->title)>30?substr($nw?->title,0)."...":$news->title;
                                                                // $headline=strlen($nw?->headline)>100?substr($nw->headline,100)."...":$news->headline;
                                                                ?>
                                                            {{$nw->title}}</p>
                                                        <p class=" {{$current_news?->id==$nw?->id?"text-white":"text-muted"}}">

                                                            {{$nw->headline}}</p>
                                                    </div>
                                                </a>
                                             </li>

                                             @endforeach
                                            </ul>
                                    @endif

                            <div class="px-5 py-2 d-flex justify-content-end">
                                @if (method_exists($news, 'links'))
                                    {{ $news?->links() }}
                                @endif
                            </div>
                            <!--end /table-->
                        </div>
                        <!--end /tableresponsive-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div> <!-- end col -->

            <!-- end col -->
        </div>
    </div>
</div>
@endsection
