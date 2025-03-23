<div class="row mt-2">
    <div class="col-lg-12 px-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Adding Exercise questios for {{ $resource->title }}</h4>
            </div>
            <!--end card-header-->
            <div class="card-body">
                <div class="col-sm-8">
                    <label class="form-label">Exercise Title</label>
                    <input type="text" name="name" required class="form-control">
                </div>
                @include('Elearning.Course.Resource.tf_form')
                @include('Elearning.Course.Resource.bs_form')
                <hr class="dashed">
                <hr class="dashed">
                @include('Elearning.Course.Resource.multiple_choice_form')
            </div>

            <div class="d-flex justify-content-end mb-4 mx-4">

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>

</div> <!-- end col -->

</div>
