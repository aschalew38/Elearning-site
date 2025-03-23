<div class="tab-pane fade" id="exercise" role="tabpanel" aria-labelledby="Exercise Tab">
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">The Course consist {{ $course?->Sections?->count() }} Exercise(s)</h4>
                    <p class="text-muted mb-0">
                        {{ $course->overview }}
                    </p>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="accordion" id="accordionExample-faq">

                        @foreach ($course->Sections as $section)
                            <div class="accordion-item">

                                <h2 class="accordion-header mt-0" id="headingOne">
                                    <button class="accordion-button shadow-none collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#it_{{ $loop->index }}"
                                        aria-expanded="false" aria-controls="it_{{ $loop->index }}">
                                        {{ $section->title }}

                                    </button>
                                </h2>
                                <div id="it_{{ $loop->index }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample-faq" style="">
                                    <div class="accordion-body">
                                        <ul>

                                            @foreach ($section->resources as $resource)
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        {{ $resource->title }}
                                                        <a
                                                            href={{ route('assessment.create', ['resource' => $resource->id]) }}>
                                                            new Exercise</a>
                                                    </div>
                                                    <ol>
                                                        {{-- @dump($resource->resourceAssessments[0]->assessment->name); --}}
                                                        @foreach ($resource->resourceAssessments as $ass)
                                                            <li>
                                                                {{-- @dump($section); --}}
                                                                <a
                                                                    href="{{ route('assessment.show', ['resource' => $resource->id, 'assessment' => $ass->assessment->id]) }}">{{ $ass->assessment->name }}</a>
                                                            </li>
                                                        @endforeach

                                                    </ol>
                                                </li>
                                            @endforeach
                                        </ul>
                                        </li>

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
