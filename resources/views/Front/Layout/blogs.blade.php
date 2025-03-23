<div class="row col-md-10 mx-auto my-4">
    @if ($blogs->count() > 0)
    @foreach ($blogs as $blog)


        {{-- @for ($i = 0; $i <= 1 && $i < $blogs->count(); $i++) --}}
            <div class="col-md-10 mx-auto py-4">
                <div class="card shadow py-4">
                    <div class="card-body">
                        <div class="blog-card d-flex flex-row gap-4   ">
                            <div class="col-md-3">

                                <img src="{{ asset('storage/' . $blog['cover']) }}" alt="" class="img-fluid rounded" style="">
                            </div>
                            <div class="mx-4">
                               {{-- @if($blog?->count()>0) --}}
                                <h4 class="my-3">
                                    <a href="{{ route('blog.show', ['blog' => $blog->id]) }}"
                                        class="">{{ $blog->title }}</a>
                                </h4>
                                <p class="text-muted text-justify">

                                    {{ $blog->overview }}
                                    {{-- {{ strlen($blog->overview) > 100 ? substr($blog->overview, 100) . '...' : $blogs->overview }} --}}
                                </p>


                                <hr class="hr-dashed">
                                <div class="d-flex justify-content-between">
                                    <div class="meta-box">
                                        <div class="media">
                                            <div class="media-body align-self-center text-truncate">
                                                <ul class="p-0 list-inline mb-0 d-flex flex-row justify-content-between">

                                                    <li class="list-inline-item mx-4">Posted By <a href="#">{{$blog?->author?->name}}</a></li>
                                                    <li class="list-inline-item mx-4">
                                                        {{ Carbon\Carbon::parse($blog->created_at)->format('M  d , Y') }}
                                                    </li>
                                                </ul>
                                            </div><!--end media-body-->
                                        </div>
                                    </div><!--end meta-box-->
                                </div>
                                    <div class="align-self-center mt-4 py-4">
                                        <a href="{{ route('blog.show', ['blog' => $blog->id]) }}"
                                            class="text-white btn btn-primary px-4 py-2 shadow">Read more <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                            </div>
                        </div><!--end blog-card-->

                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
        {{-- @endfor --}}
        @endforeach
        {{-- <hr style="height:1px;border:none;color:#333;background-color:#333;" class="my-4"> --}}

    @else
        <div class="media-body align-self-center text-center min-vh-50 my-4 py-4">
            <h5 class="mb-1 fw-bold mt-4 py-4">NO Blog</h5>
            <span>Oh! There is no Blog Yet</span>
        </div>

    @endif
    <!--end col-->
</div>
