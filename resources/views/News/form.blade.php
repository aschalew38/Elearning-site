<div class="row mt-2">
    <div class="col-lg-10 mx-auto px-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Post News</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="mb-4">
                            <label class="form-label" for="name">Title</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="{{ $news ? $news->name : 'news title' }}" id="title" required="">
                        </div>
                        @error('title')
                            <p class="text-danger px-4">{{ @message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="mb-3">
                            <label class="form-label" for="headline">Headline</label>
                            <input type="text" name="headline" class="form-control"
                                placeholder="{{ $news ? $news->headline : 'headline' }}" id="headline" required="">
                        </div>
                        @error('headline')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <hr class="dashed">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">news Body</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" placeholder="{{ $news ? $news->body : '' }}" rows="10" name="body"
                                    id="overview"></textarea>
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
