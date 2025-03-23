 <div class="row mt-2">
     <div class="col-lg-12 px-3">
         {{-- {{ $digitalSolution->partners }} --}}
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title">Digital Technology Registration</h4>
             </div>
             <!--end card-header-->
             <div class="card-body">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label" for="username">Title</label>
                             <input type="text" name="title" class="form-control"
                                 value="{{ $digitalSolution?->title ?? old('title') }}"
                                 placeholder="{{ $digitalSolution ? $digitalSolution->title : 'Your solution title' }}"
                                 id="title">
                         </div>
                         @error('title')
                             <p class="text-danger px-4">{{ $message }}</p>
                         @enderror
                     </div>
                     <div class="col-md-6">
                         <label class="mb-1">Sector</label>
                         <select name="sector"
                             class="select2 form-control mb-3 custom-select select2-hidden-accessible"
                             style="width: 100%;" tabindex="-1" aria-hidden="true">
                             {{-- @if ($digitalSolution)
                             @endif --}}
                             <option>Select</option>
                             @foreach ($catagories as $catagory)
                                 <option value="{{ $catagory->name }}" @if ($catagory->name == $digitalSolution?->sector) selected @endif
                                     {{-- {{ $catagory->name==$digitalSolution->sector?"selected":"" }} --}}>{{ $catagory->name }}</option>
                             @endforeach
                         </select>
                         @error('sector')
                             <p class="text-danger px-4">{{ @message }}</p>
                         @enderror
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label" for="focus_area">Focus Area</label>
                             <input type="text" name="focus_area" class="form-control"
                                 value="{{ $digitalSolution?->focus_area ?? old('focus_area') }}"
                                 placeholder="{{ $digitalSolution ? $digitalSolution->focus_area : 'Focus Area' }}"
                                 id="title">
                         </div>
                         @error('focus_area')
                             <p class="text-danger px-4">{{ $message }}</p>
                         @enderror

                         <div class="mb-3">
                             <fieldset>
                                 @if ($digitalSolution?->TargetGroups?->count()>0)

                                     @foreach ($digitalSolution->TargetGroups as $group)
                                         <div class="repeater-custom-show-hide">
                                             <div data-repeater-list="tgroup">
                                                 <div data-repeater-item="">
                                                     <div class="form-group row  d-flex align-items-end">
                                                         <div class="col-sm-8">
                                                             <label class="form-label">Target Group</label>
                                                             <input type="text" name="tgroup[0][name]"
                                                                 value="{{ $group->name }}" class="form-control">
                                                         </div>

                                                         <div class="col-sm-1">
                                                             <span data-repeater-delete=""
                                                                 class="btn btn-outline-danger rounded-0">
                                                                 <i class="fas fa-times-circle"></i>
                                                             </span>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group row mb-0">
                                                 <div class="col-sm-12 d-flex justify-content-end px-4">
                                                     <span data-repeater-create="" class="btn btn-outline-secondary">
                                                         <span class="fa fa-plus"></span> Add Target Group
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 @else
                                     <div class="repeater-custom-show-hide">
                                         <div data-repeater-list="tgroup">
                                             <div data-repeater-item="">
                                                 <div class="form-group row  d-flex align-items-end">
                                                     <div class="col-sm-8">
                                                         <label class="form-label">Target Group</label>
                                                         <input type="text" name="tgroup[0][name]"
                                                             class="form-control">
                                                     </div>

                                                     <div class="col-sm-1">
                                                         <span data-repeater-delete=""
                                                             class="btn btn-outline-danger rounded-0">
                                                             <i class="fas fa-times-circle"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group row mb-0">
                                             <div class="col-sm-12 d-flex justify-content-end px-4">
                                                 <span data-repeater-create="" class="btn btn-outline-secondary">
                                                     <span class="fa fa-plus"></span> Add Target Group
                                                 </span>
                                             </div>
                                         </div>
                                     </div>
                                 @endif
                             </fieldset>
                         </div>
                         @error('focus_area')
                             <p class="text-danger px-4">{{ @message }}</p>
                         @enderror


                     </div>
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label" for="url">Web URL</label>
                             <input type="url" name="url" class="form-control"
                                 value="{{ $digitalSolution?->url ?? old('url') }}"
                                 placeholder="{{ $digitalSolution ? $digitalSolution->url : 'https://' }}"
                                 id="url">
                         </div>
                         @error('url')
                             <p class="text-danger px-4">{{ $message }}</p>
                         @enderror

                         <div class="mb-3">
                             <fieldset>
                                 @if ($digitalSolution?->geographic_areas?->count()>0)
                                     @foreach ($digitalSolution->geographic_areas as $area)
                                         <div class="repeater-custom-show-hide">
                                             <div data-repeater-list="area">
                                                 <div data-repeater-item="">
                                                     <div class="form-group row  d-flex align-items-end">
                                                         <div class="col-sm-8">
                                                             <label class="form-label">Geographical Coverage
                                                                 Area</label>
                                                             <input type="text" name="area[0][name]"
                                                                 value="{{ $area->name }}" class="form-control">
                                                         </div>

                                                         <div class="col-sm-1">
                                                             <span data-repeater-delete=""
                                                                 class="btn btn-outline-danger rounded-0">
                                                                 <i class="fas fa-times-circle"></i>
                                                             </span>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group row mb-0">
                                                 <div class="col-sm-12 d-flex justify-content-end px-4">
                                                     <span data-repeater-create="" class="btn btn-outline-secondary">
                                                         <span class="fa fa-plus"></span> Add Area
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 @else
                                     <div class="repeater-custom-show-hide">
                                         <div data-repeater-list="area">
                                             <div data-repeater-item="">
                                                 <div class="form-group row  d-flex align-items-end">
                                                     <div class="col-sm-8">
                                                         <label class="form-label">Geographical Coverage Area</label>
                                                         <input type="text" name="area[0][name]"
                                                             class="form-control">
                                                     </div>

                                                     <div class="col-sm-1">
                                                         <span data-repeater-delete=""
                                                             class="btn btn-outline-danger rounded-0">
                                                             <i class="fas fa-times-circle"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group row mb-0">
                                             <div class="col-sm-12 d-flex justify-content-end px-4">
                                                 <span data-repeater-create="" class="btn btn-outline-secondary">
                                                     <span class="fa fa-plus"></span> Add Area
                                                 </span>
                                             </div>
                                         </div>
                                     </div>
                                 @endif
                             </fieldset>
                         </div>
                         @error('focus_area')
                             <p class="text-danger px-4">{{ @message }}</p>
                         @enderror
                     </div>
                 </div>
                 <hr class="dashed">
                 <hr class="dashed">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Project Team Members</h4>
                         </div>
                         <!--end card-header-->
                         <div class="card-body">
                             <fieldset>
                                 @if ($digitalSolution?->team?->count()>0)
                                     @foreach ($digitalSolution->team as $member)
                                         <div class="repeater-custom-show-hide">
                                             <div data-repeater-list="team">
                                                 <div data-repeater-item="">
                                                     <div class="form-group row  d-flex align-items-end">

                                                         <div class="col-sm-3">
                                                             <label class="form-label">Full Name</label>
                                                             <input type="text" name="team[0][name]"
                                                                 value="{{ $member->name }}" class="form-control">
                                                         </div>

                                                         <div class="col-sm-3">
                                                             <label class="form-label">email</label>
                                                             <input type="email" name="team[0][email]"
                                                                 value="{{ $member->email }}" class="form-control">
                                                         </div>
                                                         <div class="col-sm-3">
                                                             <label class="form-label">phone</label>
                                                             <input type="phone" name="team[0][phone]"
                                                                 value="{{ $member->phone }}" class="form-control">
                                                         </div>
                                                         <!--end col-->

                                                         <div class="col-sm-1">
                                                             <span data-repeater-delete=""
                                                                 class="btn btn-outline-danger rounded-0">
                                                                 <i class="fas fa-times-circle"></i>
                                                             </span>
                                                         </div>
                                                     </div>
                                                     <!--end row-->
                                                 </div>
                                                 <!--end /div-->


                                                 <!--end /div-->

                                             </div>
                                             <!--end repet-list-->

                                             <div class="form-group row mb-0">
                                                 <div class="col-sm-12 d-flex justify-content-end px-4">
                                                     <span data-repeater-create="" class="btn btn-outline-secondary">
                                                         <span class="fa fa-plus"></span> Add
                                                     </span>
                                                 </div>
                                                 <!--end col-->
                                             </div>
                                             <!--end row-->
                                         </div>
                                     @endforeach
                                 @else
                                     <div class="repeater-custom-show-hide">
                                         <div data-repeater-list="team">
                                             <div data-repeater-item="">
                                                 <div class="form-group row  d-flex align-items-end">

                                                     <div class="col-sm-3">
                                                         <label class="form-label">Full Name</label>
                                                         <input type="text" name="team[0][name]"
                                                             class="form-control">
                                                     </div>

                                                     <div class="col-sm-3">
                                                         <label class="form-label">email</label>
                                                         <input type="email" name="team[0][email]"
                                                             class="form-control">
                                                     </div>
                                                     <div class="col-sm-3">
                                                         <label class="form-label">phone</label>
                                                         <input type="phone" name="team[0][phone]"
                                                             class="form-control">
                                                     </div>
                                                     <!--end col-->

                                                     <div class="col-sm-1">
                                                         <span data-repeater-delete=""
                                                             class="btn btn-outline-danger rounded-0">
                                                             <i class="fas fa-times-circle"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 <!--end row-->
                                             </div>
                                             <!--end /div-->


                                             <!--end /div-->

                                         </div>
                                         <!--end repet-list-->

                                         <div class="form-group row mb-0">
                                             <div class="col-sm-12 d-flex justify-content-end px-4">
                                                 <span data-repeater-create="" class="btn btn-outline-secondary">
                                                     <span class="fa fa-plus"></span> Add
                                                 </span>
                                             </div>
                                             <!--end col-->
                                         </div>
                                         <!--end row-->
                                     </div>
                                 @endif
                                 <!--end repeter-->
                             </fieldset>
                             <!--end fieldset-->
                             <!--end form-->
                         </div>
                         <!--end card-body-->
                     </div>
                     <!--end card-->
                 </div>
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Lead and Partner Orginizations</h4>
                         </div>
                         <!--end card-header-->
                         <div class="card-body">
                             <fieldset>
                                 @if ($digitalSolution?->partners?->count()>0)
                                     @foreach ($digitalSolution->partners as $partner)
                                         <div class="repeater-custom-show-hide">
                                             <div data-repeater-list="part" class="">

                                                 <div data-repeater-item="" class="my-4">
                                                     <div class="form-group row  d-flex align-items-end">

                                                         <div class="col-sm-4">
                                                             <label class="form-label">Name</label>
                                                             <input type="text" value="{{ $partner->name }}"
                                                                 name="part[0][name]" class="form-control">
                                                         </div>

                                                         <div class="col-sm-4">
                                                             <label class="form-label">email</label>
                                                             <input type="email" name="part[0][email]"
                                                                 value="{{ $partner->email }}" class="form-control">
                                                         </div>
                                                         <div class="col-sm-4">
                                                             <label class="form-label">phone</label>
                                                             <input type="phone" name="part[0][phone]"
                                                                 value="{{ $partner->phone }}" class="form-control">
                                                         </div>
                                                         <div class="col-sm-4">
                                                             <label class="form-label">Logo</label>
                                                             <div
                                                                 class="d-flex flex-row align-items-end justify-content-space">
                                                                 @if ($partner->logo)
                                                                     <img src="{{ asset('storage/' . $partner->logo) }}"
                                                                         width="50px" height="50px"
                                                                         class="rounded-circle" />
                                                                 @endif
                                                                 <input type="file" name="part[0][logo]"
                                                                     value="{{ $partner->logo }}"
                                                                     class="form-control col-7">
                                                             </div>
                                                         </div>
                                                         <div class="col-sm-4">
                                                             <label class="form-label">Website</label>
                                                             <input type="url" name="part[0][url]"
                                                                 value="{{ $partner->url }}" placeholder="https://"
                                                                 class="form-control">
                                                         </div>
                                                         <!--end col-->
                                                         <div class="col-sm-3">
                                                             <label class="mb-1">Type</label>
                                                             <select class="form-select" arial-label="select"
                                                                 name="part[0][type]" class="form-control mb-3"
                                                                 style="width: 100%;">

                                                                 <option value='Lead'
                                                                     @if ($partner->type == 'Lead') selected @endif>
                                                                     Lead</option>
                                                                 <option value='Sponsor'
                                                                     @if ($partner->type == 'Sponsor') selected @endif>
                                                                     Sponsor</option>
                                                                 <option value="Implementing"
                                                                     @if ($partner->type == 'Implementing') selected @endif>
                                                                     Implementing</option>
                                                             </select>

                                                             @error('type')
                                                                 <p class="text-danger px-4">{{ message }}</p>
                                                             @enderror
                                                         </div>
                                                         <div class="col-sm-6 mt-2">
                                                            <label class="mb-1">Org. Type</label>
                                                            <select class="form-select" arial-label="select"
                                                                name="part[0][organization_type_id]" class="form-control mb-3"
                                                                style="width: 100%;" required>
                                                                @foreach ($office_types as $ty)

                                                                <option value={{ $ty->id }}
                                                                    @if($partner->organization_type_id == $ty->id) selected @endif
                                                                    >{{ $ty->name }}</option>
                                                                @endforeach
                                                                {{-- <option value='Sponsor'>Sponsor</option> --}}
                                                                {{-- <option value="Implementing">Implementing</option> --}}
                                                            </select>
                                                            @error('organization_type_id')
                                                                <p class="text-danger px-4">{{ message }}</p>
                                                            @enderror
                                                        </div>
                                                         <div class="col-sm-1">
                                                             <span data-repeater-delete=""
                                                                 class="btn btn-outline-danger rounded-0">
                                                                 <i class="fas fa-times-circle"></i>
                                                             </span>
                                                         </div>
                                                     </div>
                                                     <!--end row-->
                                                     <hr class="dashed text-primary">

                                                 </div>
                                                 <!--end /div-->

                                                 <!--end /div-->

                                             </div>
                                             <!--end repet-list-->

                                             <div class="form-group row mb-0">
                                                 <div class="col-sm-12 d-flex justify-content-end px-4">
                                                     <span data-repeater-create="" class="btn btn-outline-secondary">
                                                         <span class="fa fa-plus"></span> Add
                                                     </span>
                                                 </div>
                                                 <!--end col-->
                                             </div>
                                             <!--end row-->
                                         </div>
                                     @endforeach
                                 @else
                                     <div class="repeater-custom-show-hide">
                                         <div data-repeater-list="part" class="">

                                             <div data-repeater-item="" class="my-4">
                                                 <div class="form-group row  d-flex align-items-end">

                                                     <div class="col-sm-4">
                                                         <label class="form-label">Name</label>
                                                         <input type="text" name="part[0][name]"
                                                             class="form-control">
                                                     </div>

                                                     <div class="col-sm-4">
                                                         <label class="form-label">email</label>
                                                         <input type="email" name="part[0][email]"
                                                             class="form-control">
                                                     </div>
                                                     <div class="col-sm-4 ">
                                                         <label class="form-label">phone</label>
                                                         <input type="phone" name="part[0][phone]"
                                                             class="form-control">
                                                     </div>
                                                     <div class="col-sm-6 mt-1">
                                                         <label class="form-label">Logo</label>
                                                         <input type="file" name="part[0][logo]" value=""
                                                             class="form-control">
                                                     </div>
                                                     <div class="col-sm-6 mt-1">
                                                         <label class="form-label">Website</label>
                                                         <input type="url" name="part[0][url]"
                                                             placeholder="https://" class="form-control">
                                                     </div>
                                                     <!--end col-->
                                                     <div class="col-sm-5 mt-1">
                                                         <label class="mb-1">Partner Type</label>
                                                         <select class="form-select" arial-label="select"
                                                             name="part[0][type]" class="form-control mb-3"
                                                             style="width: 100%;">
                                                             @if ($digitalSolution)
                                                             @endif
                                                             <option value='Lead'>Lead</option>
                                                             <option value='Sponsor'>Sponsor</option>
                                                             <option value="Implementing">Implementing</option>
                                                         </select>
                                                         @error('type')
                                                             <p class="text-danger px-4">{{ message }}</p>
                                                         @enderror
                                                     </div>
                                                     <div class="col-sm-6">
                                                         <label class="mb-1">Org. Type</label>
                                                         <select class="form-select" arial-label="select"
                                                             name="part[0][organization_type_id]" class="form-control mb-3"
                                                             style="width: 100%;">
                                                             @foreach ($office_types as $ty)

                                                             <option value={{ $ty->id }}>{{ $ty->name }}</option>
                                                             @endforeach
                                                             {{-- <option value='Sponsor'>Sponsor</option> --}}
                                                             {{-- <option value="Implementing">Implementing</option> --}}
                                                         </select>
                                                         @error('organization_type_id')
                                                             <p class="text-danger px-4">{{ message }}</p>
                                                         @enderror
                                                     </div>
                                                     <div class="col-sm-1">
                                                         <span data-repeater-delete=""
                                                             class="btn btn-outline-danger rounded-0">
                                                             <i class="fas fa-times-circle"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 <!--end row-->
                                                 <hr class="dashed text-primary">

                                             </div>

                                         </div>

                                         <div class="form-group row mb-0">
                                             <div class="col-sm-12 d-flex justify-content-end px-4">
                                                 <span data-repeater-create="" class="btn btn-outline-secondary">
                                                     <span class="fa fa-plus"></span> Add
                                                 </span>
                                             </div>
                                             <!--end col-->
                                         </div>
                                         <!--end row-->
                                     </div>
                                 @endif


                                 <!--end repeter-->
                             </fieldset>
                             <!--end fieldset-->
                             <!--end form-->
                         </div>
                         <!--end card-body-->
                     </div>
                     <!--end card-->
                 </div>
                 <hr class="dashed">

                 <div class="row">
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Objective</h4>
                             </div>
                             <!--end card-header-->
                             <div class="card-body">
                                 <textarea class="form-control" rows="5" name="objective" value={{ $digitalSolution?->objective }}
                                     placeholder="{{ $digitalSolution ? $digitalSolution->objective : '' }}" id="message">
                                     {{ $digitalSolution?->objective }}
                                    </textarea>
                             </div>
                         </div>

                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Description</h4>
                             </div>
                             <!--end card-header-->
                             <div class="card-body">
                                 <textarea class="form-control" value={{ $digitalSolution?->detail }}
                                     placeholder="{{ $digitalSolution ? $digitalSolution->detail : '' }}" rows="10" name="detail"
                                     id="message">{{ $digitalSolution?->detail }}</textarea>
                             </div>
                         </div>

                     </div>
                     <div class="col-xl-6">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Poster</h4>
                             </div>
                             <!--end card-header-->
                             @if($digitalSolution?->poster)
                             <img src="{{ asset('storage/' . $digitalSolution->poster) }}" />
                            @endif
                             <div class="card-body">
                                 <input type="file" id="poster" name="poster" class="dropify"
                                     data-height="300" />
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="card">
                                 <div class="card-header">
                                     <h4 class="card-title">Add Gallery</h4>
                                 </div>
                                 <!--end card-header-->
                                 <div class="card-body">
                                     <fieldset>
                                         <div class="repeater-custom-show-hide">
                                             <div data-repeater-list="gallery">
                                                 <div data-repeater-item="">
                                                     <div class="form-group row  d-flex align-items-end">
                                                         <div class="col-sm-8">
                                                             <input type="file" name="gallery[0][photo]"
                                                                 class="form-control">
                                                         </div>
                                                         <!--end col-->
                                                         <div class="col-sm-1">
                                                             <span data-repeater-delete=""
                                                                 class="btn btn-outline-danger rounded-0">
                                                                 <i class="fas fa-times-circle"></i>
                                                             </span>
                                                         </div>
                                                     </div>
                                                     <!--end row-->
                                                 </div>
                                                 <!--end /div-->


                                                 <!--end /div-->

                                             </div>
                                             <!--end repet-list-->

                                             <div class="form-group row mb-0">
                                                 <div class="col-sm-12 d-flex justify-content-end px-4">
                                                     <span data-repeater-create="" class="btn btn-outline-secondary">
                                                         <span class="fa fa-plus"></span> Add
                                                     </span>
                                                 </div>
                                                 <!--end col-->
                                             </div>
                                             <!--end row-->
                                         </div>
                                         <!--end repeter-->
                                     </fieldset>
                                     <!--end fieldset-->
                                     <!--end form-->
                                 </div>
                                 <!--end card-body-->
                             </div>
                             <!--end card-->
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
 {{-- @if ($errors->has()) --}}
 @foreach ($errors->all() as $error)
     <div>{{ $error }}</div>
 @endforeach
 {{-- @endif --}}
