<div class="row">
    <div class="col-md-10">
        <h5>Fill the blank Questions</h5>
        <div class="mb-3">
            <fieldset>
                <div class="repeater-custom-show-hide">
                    <div data-repeater-list="bsquestions">
                        <div data-repeater-item="">
                            <div class="form-group row  d-flex align-items-end">
                                <div class="col-sm-8">
                                    <label class="form-label">Question</label>
                                    <input type="text" name="tfquestions[0][question]" required class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <span data-repeater-delete="" class="btn btn-outline-danger rounded-0">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                </div>

                                <div class="row my-3">
                                    <div class="col-md-3">
                                        <label class=" my-1 form-label">Answer</label>
                                        <input type="text" name="tfquestions[0][answer]" required
                                            class="form-control">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-12 d-flex justify-content-end px-4">
                            <span data-repeater-create="" class="btn btn-outline-secondary">
                                <span class="fa fa-plus"></span> Add Blank space Question
                            </span>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        @error('focus_area')
            <p class="text-danger px-4">{{ $message }}</p>
        @enderror


    </div>

</div>
