@php
    $layout_class = $course->Instructor_id == auth()->user()->id ? 'col-lg-8 mx-auto' : 'col-lg-11 mx-auto';
@endphp
<div class="tab-pane fade active show" id="Syllabus" role="tabpanel" aria-labelledby="Syllabus Tab">
    <div class="row">
        <div class={{ $layout_class }}>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-decoration-underline">The Course consist
                        {{ $course?->Sections?->count() }} Sections</h4>
                    <br>
                    <p class="text-muted mb-0 mt-2">
                        {{ $course->overview }}
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <ol>

                        @foreach ($course->Sections as $section)
                            <li class="font-weight-bolder font-14">
                                <h6 class="text-primary">{{ $section->title }}</h6>

                                <p style="text-align: justify" class="mx-2">{{ $section->overview }} </p>
                            </li>
                            {{-- <p>{{ $section->overview }}</p> --}}
                        @endforeach
                        @if ($course->courseAssessments?->count() > 0)

                            <h5>Exam</h5>
                            @foreach ($course->courseAssessments as $courseAssessment)
                                <li>
                                    {{-- @dump($section); --}}
                                    <a
                                        href="{{ route('final_exam', ['assessment' => $courseAssessment->assessment->id]) }}">{{ $courseAssessment->assessment->name }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ol>
                    <!--end accordion-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        @if ($course->Instructor_id == auth()->user()->id)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Section to course</h4>
                        <p class="text-muted mb-0"></p>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('sections.store', ['course' => $course->id]) }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-lg-12  mo-b-15">
                                            <input class="form-control" type="text" id="title" name="title"
                                                placeholder="Title">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="overview" id="overview" rows="4" placeholder="Oveview of Section"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block px-4">Save</button>
                                </form>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
                <div class="">
                    <a class="btn btn-primary" href="{{ route('add_exam', ['course' => $course]) }}">ADD Exam</a>
                    <a class="btn btn-primary" href="{{ route('add_test', ['course' => $course]) }}">ADD Test</a>
                </div>
            </div>
        @endif


        <!--end col-->
    </div>
</div>
