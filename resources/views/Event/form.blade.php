<div class="row mt-2">
    <div class="col-lg-10 mx-auto px-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Post event</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="mb-4">
                            <label class="form-label" for="type">Type</label>
                            <input type="text" name="type" class="form-control"
                                    value="{{ $event->type??old('type') }}"
                                placeholder="{{ $event? $event->type : 'Event Type' }}" id="type" required="">
                        </div>
                        @error('title')
                            <p class="text-danger px-4">{{ @message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="mb-3">
                            <label class="form-label" for="about">About</label>
                            <input type="text" name="about" class="form-control"
                                value="{{ $event->about??old('about') }}"
                                placeholder="{{ $event ? $event->about : 'about' }}" id="about" required="">
                        </div>
                        @error('about')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="starting_date">Starting Date</label>
                            <input type="date" name="starting_date" class="form-control"
                                value="{{ $event->starting_date??old('starting_date') }}"
                                placeholder="{{ $event ? $event->starting_date : 'dd-mm-yyyy' }}" id="starting_date" required="">
                        </div>
                        @error('starting_date')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label" for="starting_time">Starting Time</label>
                            <input type="time" name="starting_time" class="form-control"
                                value="{{ $event->starting_time??old('starting_time') }}"
                                placeholder="{{ $event ? $event->starting_time : 'dd-mm-yyyy' }}" id="starting_time" required="">
                        </div>
                        @error('starting_time')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="ending_date">End Date</label>
                            <input type="date" name="ending_date" class="form-control"
                               value="{{ $event->ending_date??old('ending_date') }}"
                                placeholder="{{ $event ? $event->ending_date : 'dd-mm-yy' }}" id="ending_date" required="">
                        </div>
                        @error('ending_date')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <hr class="dashed">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Event Body</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" placeholder="{{ $event ? $event?->body : '' }}" rows="10" name="body"
                                    id="body">
                                {{ $event->body??old('body') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Poster</h4>
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="poster" name="poster" class="dropify" data-height="300" />
                            </div>
                        </div>

                        <hr class="dashed">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mb-4 mx-4">

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

</div> <!-- end col -->

</div>
