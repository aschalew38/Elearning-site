@php
    $question = null;
@endphp
<div class="row">
    <div class="col-md-10">
        <h5><u>Multiple Choice Questions</u></h5>
        <div class="mb-3">
            <fieldset>
                <div class="repeater-custom-show-hide">
                    <div data-repeater-list="mcquestions">
                        <div data-repeater-item="">
                            <div class="form-group row  d-flex align-items-end">
                                {{-- Start of Questions  --}}

                                <div class="form-group col-md-12">
                                    <label for="question_field">Question</label>
                                    <textarea type="text" id="question_field" name="question" class="form-control @error('question') is-invalid @enderror"
                                        required cols="30" rows="3">{{ old('question') ?? ($question?->question ?? '') }}</textarea>
                                    @error('question')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="A">Choice A</label>
                                    <input type="text" id="A" name="A" value="{{ old('A') }}"
                                        required class="form-control @error('A') is-invalid @enderror">
                                    @error('B')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="B">Choice B</label>
                                    <input type="text" id="B" name="B" value="{{ old('B') }}"
                                        required class="form-control @error('B') is-invalid @enderror">
                                    @error('B')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group col-md-6">
                                    <label for="C">Choice C</label>
                                    <input type="text" id="C" name="C" value="{{ old('C') }}"
                                        required class="form-control @error('C') is-invalid @enderror">
                                    @error('C')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="D">Choice D</label>
                                    <input type="text" id="D" name="D" value="{{ old('D') }}"
                                        class="form-control @error('D') is-invalid @enderror">
                                    @error('D')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="E">Choice E</label>
                                    <input type="text" id="E" name="E" value="{{ old('E') }}"
                                        class="form-control @error('E') is-invalid @enderror">
                                    @error('E')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="answer_field">Answer</label>
                                    <select name="mcquestions[0][answer]" class="form-control" required
                                        id="answer_field">
                                        <option value="A">A
                                        </option>
                                        <option value="B">B
                                        </option>
                                        <option value="C">C
                                        </option>
                                        <option value="D">D
                                        </option>
                                        <option value="E">E
                                        </option>
                                    </select>
                                    @error('answer')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="answer_field">Remove Question</label>
                                    <div class="col-sm-1">
                                        <span data-repeater-delete="" class="btn btn-outline-danger rounded-0">
                                            <i class="fas fa-times-circle"></i>
                                        </span>
                                    </div>
                                </div>

                                {{-- End of Questions  --}}


                                {{-- start of choice  --}}



                                {{-- end of choice --}}




                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-12 d-flex justify-content-end px-4">
                            <span data-repeater-create="" class="btn btn-outline-secondary">
                                <span class="fa fa-plus"></span> Add Multiple choice Questions Question
                            </span>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        @error('focus_area')
            <p class="text-danger px-4">{{ @message }}</p>
        @enderror


    </div>

</div>
