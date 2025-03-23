<?php
if(!isset($blog))
$blog=null;
?>
<div class="row flex my-4 py-3">
    <div class="mb-1 row flex flex-col col-md-6">
        <div class="col-sm-12">
            <label  for="title" class="col-sm-2 form-label align-self-center mb-lg-0 text-start font-weight-bold ">Title</label>
            <input class="form-control" type="title"  id="title" name="title" value="{{$blog?$blog->title:old('title')}}" >
            @error('title')
            <p class="text-danger px-4">{{ @message }}</p>
        @enderror
        </div>
    </div>
   @if($blog?->cover)
   <div class="col-md-5 d-flex justify-content-end">
   <img src="{{asset('storage/'.$blog?->cover)}}" alt="" height="100px" width="100px">
   </div>
   @endif
    <div class="mb-1 col-md-6">
        <label  for="poster" class="col-sm-2 form-label align-self-center mb-lg-0 text-start font-weight-bold">Poster</label>
        <input type="file" class="form-control " id="poster" name="poster">
        @error('poster')
        <p class="text-danger px-4">{{ @message }}</p>
    @enderror
    </div>
</div>
<div class="mb-3">
    <label class="form-label font-weight-bold" for="overview">Overview of Resource</label>
    <textarea class="form-control" rows="3" id="overview" name="overview">

        {{$blog?->overview}}
    </textarea>
    @error('overview')
    <p class="text-danger px-4">{{ @message }}</p>
@enderror
</div>

<div class="mb-3">
    <label class="form-label font-weight-bolder" for="overview">Content</label>
    <textarea class="form-control" rows="7" id="content" name="content">

        {{$blog?->content}}
    </textarea>
    @error('content')
    <p class="text-danger px-4">{{ @message }}</p>
@enderror
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
