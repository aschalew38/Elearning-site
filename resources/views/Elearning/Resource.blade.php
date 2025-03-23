@php
    $layout_class = $course->Instructor_id == auth()->user()->id ? 'col-lg-8 mx-auto' : 'col-lg-11 mx-auto';
@endphp
<div class="tab-pane fade" id="resource" role="tabpanel" aria-labelledby="resource Tab">
    <div class="row">
        <div class={{ $layout_class }}>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">The Course consist {{ $course?->Sections?->count() }} Sections</h4>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="accordion" id="accordionExample-faq">
                        @foreach ($course->Sections as $section)
                            <div class="accordion-item">
                                <h2 class="accordion-header mt-0" id="headingOne">
                                    <button class="accordion-button shadow-none collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#its_{{ $loop->index }}_col"
                                        aria-expanded="false" aria-controls="its_{{ $loop->index }}_col">
                                        {{ $section->title }}
                                    </button>
                                </h2>

                                <div id="its_{{ $loop->index }}_col" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample-faq" style="">
                                    <div class="accordion-body">
                                        @if ($course->Instructor_id == auth()->user()->id)
                                            <div class="align-content-end">
                                                <div class="d-flex justify-content-end">

                                                    <button class="btn btn-primary mx-4" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#sec{{ $section->id }}_vid"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                        Add New Video
                                                    </button>
                                                    <button class="btn btn-primary" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#sec{{ $section->id }}__doc"
                                                        aria-expanded="false" aria-controls="collapseExample1">
                                                        Add New Pdf
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('resource.store', ['section' => $section->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="collapse" id="sec{{ $section->id }}_vid">
                                                        <div class="card card-body">
                                                            <video class="col-md-10 my4 mx-3" autoplay controls>
                                                                <source src="mov_bbb.mp4" id="video_here">
                                                                Your browser does not support HTML5 video.
                                                            </video>
                                                            <div class="form-group row my-4">
                                                                <div class="col-lg-12  mo-b-15">
                                                                    <label for="title">Title</label>
                                                                    <input class="form-control" type="text"
                                                                        id="title" name="title"
                                                                        placeholder="Title">
                                                                </div>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <label class="col-12"
                                                                    for="inputGroupFile02">Video</label>
                                                                <input type="file" name="file[]" accept="video/*"
                                                                    class="file_multi_video form-control"
                                                                    id="inputGroupFile02">
                                                                <button type="submit" class="input-group-text"
                                                                    for="inputGroupFile02">Upload</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="collapse" id="sec{{ $section->id }}__doc">
                                                        <div class="card card-body">
                                                            <div class="col-lg-12  mo-b-15">
                                                                <label for="title">Title</label>
                                                                <input class="form-control" type="text"
                                                                    id="title" name="pdftitle" placeholder="Title">
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="pdf_resource"
                                                                    accept=".pdf,.ppt,.doc,.docx"
                                                                    class="file_multi_video form-control"
                                                                    id="inputGroupFile02">
                                                                <button type="submit" class="input-group-text"
                                                                    for="inputGroupFile02">Upload</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($errors)
                                                        @foreach ($errors->all() as $error)
                                                            <div>{{ $error }}</div>
                                                        @endforeach
                                                    @endif
                                                </form>
                                            </div>
                                        @endif
                                        <ul>
                                            @if ($section->resources)
                                                @foreach ($section->resources as $resource)
                                                    <li>


                                                        @if ($course->enrolled() || $course->Instructor_id == auth()->user()->id)
                                                            @if ($resource->content_type == 'PDF')
                                                                <a target="_black"
                                                                    href="{{ asset('storage/' . $resource->path) }}">
                                                                    {{ $resource->title }}</a>
                                                            @else
                                                                <a
                                                                    href="{{ route('resources.show', ['course' => $course->id, 'section' => $section->id, 'resource' => $resource->id]) }}">
                                                                    {{ $resource->title }}</a>
                                                            @endif
                                                        @else
                                                            <span>{{ $resource->title }}</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                            @if ($section->SectionAssessments?->count() > 0)
                                                <h5>Tests</h5>
                                                @foreach ($section->SectionAssessments as $SectionAssessment)
                                                    <li>

                                                        @if ($course->enrolled() || $course->Instructor_id == auth()->user()->id)
                                                            <a
                                                                href="{{ route('assessment.show', ['assessment' => $SectionAssessment->assessment->id]) }}">
                                                                {{ $SectionAssessment->assessment->name }}</a>
                                                        @else
                                                            <span>{{ $SectionAssessment->assessment->name }}</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <!--end accordion-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
</div>
@push('js')
    <script>
        $(document).on("change", ".file_multi_video", function(evt) {
            var $source = $('#video_here');
            $source[0].src = URL.createObjectURL(this.files[0]);
            $source.parent()[0].load();
        });
    </script>
@endpush
