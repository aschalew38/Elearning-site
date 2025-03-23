@php
    $layout_class = $course->Instructor_id == auth()->user()->id ? 'col-lg-8 mx-auto' : 'col-lg-11 mx-auto';
@endphp
<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="resource Tab">
    <div class="row ">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="text-warning">Student Feedback</h2>
                                <div class="d-flex gap-10">
                                    <div class="mx-4">
                                        <h1 class="text-warning">4.5</h1>
                                        @include('Component.four_half_rating')
                                    </div>
                                    <div class="flex-col col-md-8 bg-blue-50">
                                        <div class="d-flex  justify-content-between">
                                            <div class="col-11 mx-auto  d-flex align-items-center">
                                                <div class="progress d-inline col-md-10" style="height: 40%;">
                                                    <div class="progress-bar text-lg bg-primary" role="progressbar"
                                                        style="width:75%;height: 100%;" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        75%
                                                    </div>
                                                </div>
                                                @include('Component.five_rating')
                                            </div>
                                        </div>

                                        <div class="d-flex   justify-content-between">
                                            <div class="col-11 mx-auto d-flex align-items-center">
                                                <div class="progress d-inline col-md-10" style="height: 40%;">
                                                    <div class="progress-bar bg-primary text-lg" role="progressbar"
                                                        style="width:10%;height:100%" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        10%
                                                    </div>
                                                </div>
                                                @include('Component.four_rating')
                                            </div>
                                        </div>
                                        <div class="d-flex  justify-content-between">
                                            <div class="col-11 mx-auto d-flex align-items-center">
                                                <div class="progress d-inline col-md-10" style="height: 40%;">
                                                    <div class="progress-bar bg-primary text-lg" role="progressbar"
                                                        style="width:8%;height:100%" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        8%
                                                    </div>
                                                </div>
                                                @include('Component.three_rating')
                                            </div>
                                        </div>
                                        <div class="justify-content-between">
                                            <div class="col-11 mx-auto d-flex align-items-center">
                                                <div class="progress d-inline col-md-10" style="height: 40%;">
                                                    <div class="progress-bar bg-primary text-lg" role="progressbar"
                                                        style="width:5%;height:100%" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        5%
                                                    </div>
                                                </div>
                                                @include('Component.two_rating')
                                            </div>
                                        </div>

                                        <div class="d-flex  justify-content-between">
                                            <div class="col-11 mx-auto d-flex align-items-center">
                                                <div class="progress d-inline col-md-10" style="height: 40%;">
                                                    <div class="progress-bar bg-primary text-lg" role="progressbar"
                                                        style="width:2%;height:100%" aria-valuenow="25"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        2%
                                                    </div>
                                                </div>
                                                @include('Component.one_rating')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div><!--end col-->
            </div> <!--end row-->
        </div><!--end card-header-->
        <div class="card-body">
            <ul class="list-group custom-list-group mb-n3">
                <li class="list-group-item align-items-center d-flex justify-content-between">
                    <div class="media">
                        <img src="{{ asset('BackEnd/assets/images/users/user-2.jpg') }}" height="40"
                            class="me-3 align-self-start rounded" alt="...">
                        <div class="media-body align-self-center">
                            <p class="m-0 d-block fw-semibold font-13">

                                Mamo Fideno
                            </p>
                            <div class="d-flex align-items-end">
                                @include('Component.five_rating') <span class="mx-2 text-lg" style="vertical-align:middle;">2
                                    weeks ago</span>
                            </div>
                            <p class="" style="text-align: justify;">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic
                                typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                with desktop publishing software like Aldus PageMaker including versions of Lorem
                                Ipsum.
                            </p>

                        </div><!--end media body-->
                    </div>

                </li>

            </ul>
        </div><!--end card-body-->
    </div><!--end card-->
</div>

@push('js')
@endpush
