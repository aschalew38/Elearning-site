@extends('Elearning.Classes.base')
@push('css')
    <link href="{{ asset('BackEnd/plugins/nestable/jquery.nestable.min.css') }}" rel="stylesheet" />
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
@endpush
{{-- {{ $course }} --}}
@section('content')
<div class="col-md-12">
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $resource->title }}</h4>
                        {{-- <embed type="video/mp4" src="{{ asset('storage/' . $resource->path) }}" width="400" height="300"> --}}
                            {{-- {{ $course?->poster }} --}}
                        <video  data-setup='{"liveui": true}' id="lect"
                            preload="auto" class="video-js vjs-theme-city col-md-11 mx-auto"
                            {{-- poster="{{ $course?->poster }}" --}}
                            data-setup='{"controls": true, "autoplay": false, "preload": "auto"}' type="video/mp4" controls
                            autoplay>
                            <source src="{{ asset('storage/' . $resource->path) }}" type="video/mp4">

                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                    <!--end card-header-->
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="ui-tabs-accordions.html#home"
                                    role="tab" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="ui-tabs-accordions.html#profile"
                                    role="tab" aria-selected="false">QA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="ui-tabs-accordions.html#settings"
                                    role="tab" aria-selected="false">Additional Resources</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane p-3 active" id="home" role="tabpanel">
                                <p class="mb-0 text-muted">
                                    Raw denim you probably haven't heard of them jean shorts Austin.
                                </p>
                            </div>
                            <div class="tab-pane p-3" id="profile" role="tabpanel">
                                <p class="mb-0 text-muted">
                                    Food truck fixie locavore, accusamus mcsweeney's
                                    single-origin coffee squid.
                                </p>
                            </div>
                            <div class="tab-pane p-3" id="settings" role="tabpanel">
                                <p class="text-muted mb-0">
                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-3">

                <div class="custom-dd dd" id="nestable_list_1">
                    @foreach ($course->sections as $section)
                        <li class="dd-list">

                        <li class="dd-item dd-collapsed" data-id="2"><button class="dd-collapse" data-action="collapse"
                                type="button">Collapse</button><button class="dd-expand" data-action="expand"
                                type="button">Expand</button>
                            <div class="dd-handle">
                                {{ $section->title }}
                            </div>
                            <ol class="dd-list ml-2">
                                @foreach ($section->resources as $res)
                                    <li class="dd-item" data-id="3">
                                        <div class="mx-4">
                                            <span class="text-success">
                                              @if($res->content_type=="PDF")
                                              <a href="{{ asset("storage/".$res->path) }}" target="_blank">
                                                {{-- href="{{ route('resources.show', ['course' => $course->id, 'section' => $section->id, 'resource' => $res->id]) }}"> --}}
                                                {{ $res->title }}</a>
                                              @else
                                                <input type="checkbox" id={{ $res->id }}
                                                    {{ $res->get_student_status() == 'Completed' ? 'checked' : '' }}
                                                    disabled class="mx-2 text-primary shadow"></span>
                                                    {{-- {{ $res->content_type }} --}}
                                                    <a
                                                href="{{ route('resources.show', ['course' => $course->id, 'section' => $section->id, 'resource' => $res->id]) }}">
                                                {{ $res->title }}</a>
                                            @endif
                                        </div>
                                    </li>
                                    @foreach ($res->resourceAssessments as $resourceAssessment)
                                        <li class="dd-item" data-id="3">
                                            <div class="mx-4 col-10 ml-auto">
                                                <span class="text-success">

                                                    <a class="mx-2"
                                                        href="{{ route('assessment.show', ['course' => $course->id, 'section' => $section->id, 'resource' => $res->id, 'assessment' => $resourceAssessment->assessment->id]) }}">
                                                        <i class="fas fa-question mx-2"></i>
                                                        {!! substr($resourceAssessment->assessment->name, 0, 20) !!}</a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ol>
                            @if ($section->SectionAssements)
                                @foreach ($res->SectionAssements as $resourceAssessment)
                        <li class="dd-item" data-id="3">
                            <div class="mx-4 col-10 ml-auto">
                                <span class="text-success">

                                    <a class="mx-2"
                                        href="{{ route('assessment.show', ['course' => $course->id, 'section' => $section->id, 'resource' => $res->id, 'assessment' => $resourceAssessment->assessment->id]) }}">
                                        <i class="fas fa-question mx-2"></i>
                                        {!! substr($resourceAssessment->assessment->name, 0, 20) !!}</a>
                                </span>
                            </div>
                        </li>
                    @endforeach
                    @endif
                    @endforeach

                    </li>
                    @if ($course->courseAssessments?->count() > 0)
                        @foreach ($course->courseAssessments as $courseAssessment)
                            <li>
                                {{-- @dump($section); --}}
                                <a
                                    href="{{ route('final_exam', ['assessment' => $courseAssessment->assessment->id]) }}">{{ $courseAssessment->assessment->name }}</a>
                            </li>
                        @endforeach
                    @endif
                    @if($course->certified)
                    <li>
                        {{-- {{ 'dsdsd' }} --}}
                        <a
                            href="{{ route('final_exam', ['assessment' => $courseAssessment->assessment->id]) }}">{{ $courseAssessment->assessment->name }}</a>
                    </li>
                    @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/nestable/jquery.nestable.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.nastable.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script>
        $(document).ready(function() {
            var player = videojs('#lect', {
                controlBar: {
                    skipButtons: {
                        backward: 10,
                        forward: 5
                    }
                },
                playbackRates: [0.5, 1, 1.5, 2]
            });
            console.log("Here is the vd");
            var vid = $("#lect");
            // console.log(vid[0].currentTime);
            vid.onseeking = function() {
                console.log("erfa");
            }
            let input_id = @json($resource->id);
            let input_che = $("#".concat(input_id));

            vid[0].currentTime = 10;
            console.log(vid);
            let time_t = vid[0].currentTime;

            const myInterval = setInterval(myTimer, 6000);

            function myTimer() {

                time_t = player.duration() - player.currentTime();
                // console.log(vid.currentTime());
                let t_views = player.currentTime();
                // console.log(time_t);
                let status = "Started";
                if (time_t < 5) {
                    alert("completed");
                    status = "Completed";
                    let t_views = vid[0].duration;
                    input_che.prop("checked", true);
                    clearInterval(myInterval);
                }
                // console.log("new loc");
                updateVideo_status(status, t_views);
            }

            function myStopFunction() {
                clearInterval(myInterval);
            }

            function updateVideo_status(stat, v_time) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateVideo') }}",
                    data: {
                        resource_id: input_id,
                        viewed_time: v_time,
                        status: stat,
                    },
                    success: function(data) {
                        // alert("helloo");
                    },
                    error: function(er) {
                        console.log(er);
                    }
                });

            }
        });
    </script>
@endpush
