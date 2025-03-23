@props(['partner' => null])
<div class="row mt-2">
    <div class="col-lg-10 mx-auto px-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">New Partner</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-4">
                            <label class="form-label" for="type">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $partner?->name ?? old('name') }}"
                                placeholder="{{ $partner ? $partner->type : 'Partner name' }}" id="type"
                                required="">
                        </div>
                        @error('name')
                            <p class="text-danger px-4">{{ @message }}</p>
                        @enderror
                    </div>
                    {{-- <div class="mb-3 row"> --}}
                        <div class="col-sm-3">
                            <div class="mt-1">
                            <label class="mb-1 form-label">Org. type</label>
                            <select class="form-select"  name="organization_type_id" aria-label="Default select example">
                                @foreach ($office_types as $type)

                                <option value={{ $type->id }}>{{ $type->name }}</option>
                                @endforeach
                                {{-- <option selected="">Open this select menu</option> --}}
                                {{-- <option value="2">Two</option> --}}
                                {{-- <option value="3">Three</option> --}}
                              </select>
                            </div>
                        </div>
                    {{-- </div> --}}
                    <div class="col-md-4">
                        <div class="mb-4">
                            <label class="form-label" for="type">Email</label>
                            <input type="text" name="email" class="form-control"
                                value="{{ $partner?->email ?? old('email') }}"
                                placeholder="{{ $partner ? $partner->email : 'partner Email' }}" id="email"
                                required="">
                        </div>
                        @error('email')
                            <p class="text-danger px-4">{{ @message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ $partner->phone ?? old('phone') }}"
                                placeholder="{{ $partner ? $partner->phone : 'phone' }}" id="phone" required="">
                        </div>
                        @error('phone')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" for="url">Web site address</label>
                            <input type="text" name="url" class="form-control"
                                value="{{ $partner->url ?? old('url') }}"
                                placeholder="{{ $partner ? $partner->url : 'url' }}" id="url" required="">
                        </div>
                        @error('url')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label" for="phone">Address(Area Separate with ;) </label>
                            <input type="text" name="location" class="form-control"
                                value="{{ $partner->location ?? old('location') }}"
                                placeholder="{{ $partner ? $partner->location : '1234 Sudan Streat;Addis Ababa, Ethiopia' }}" id="location" required="">
                        </div>
                        @error('phone')
                            <p class="text-danger px-4">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <hr class="dashed">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">objective</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="objective" placeholder="{{ $partner ? $partner?->objective : '' }}" rows="10" name="body"
                                    id="objective">
                                {{ $partner->objective ?? old('objective') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Description</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="description" placeholder="{{ $partner ? $partner?->description : '' }}" rows="10" name="body"
                                    id="description">
                                {{ $partner->description ?? old('description') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Success</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="success" placeholder="{{ $partner ? $partner?->success : '' }}" rows="10" name="body"
                                    id="success">
                                {{ $partner->success ?? old('success') }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Logo</h4>
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <input type="file" id="logo" name="logo" class="dropify" data-height="300" />
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
