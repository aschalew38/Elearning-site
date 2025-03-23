@extends('BackEnd.Layout.base')

@section('title', 'Digital Solution')
@section('content')
    <div class="col-lg-9 mx-4">
        <div class="card">
            <div class="card-body">
                <div class="blog-card align-items-center flex-col">
                    <h4 class="my-3">
                        <a href="pages-blogs.html" class="">There are many variations of passages of Lorem</a>
                    </h4>
                    <span class="badge badge-purple px-3 py-2 bg-soft-primary fw-semibold mt-3">
                        {{ $news->created_at->diffForHumans() }}
                    </span>
                    <br>
                    <img src="{{ asset('storage/' . $news->poster) }}" alt="" class="img-fluid rounded" />
                    <br>
                    <p class="text-muted">{{ $news->headline }}</p>

                    <span class="badge badge-purple px-3 py-2 bg-soft-primary fw-semibold mt-3">
                        <span class="mx-2">Posted By:{{ $news->postedBy()?->username }}</span>
                    </span>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <div class="meta-box">
                            <div class="media">
                                <p class="" style="text-align: justify">{{ $news->body }}</p>
                            </div><!--end media-body-->
                        </div>
                    </div><!--end meta-box-->

                </div>
            </div><!--end blog-card-->

        </div><!--end card-body-->
    </div><!--end card-->
    {{-- </div> --}}
@endsection
