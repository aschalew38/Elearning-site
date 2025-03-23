@extends('BackEnd.Layout.base')
@section('title', 'Digital Solution')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update resource</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  action="{{route('additional_resources.edit_save')}}" method="post" name="form1">
                      {{ csrf_field() }}
                <div class="card-body">
                <div class="row">
				<div class="col-sm-2">
                  <div class="form-group">
                      <label>ID</label>
					 </div> 
					</div>
				<div class="col-sm-8">	
					   <div class="form-group">
                <input type="text" class="form-control" id="id" name="id"  readonly value="{{ $post['id'] }}">
						</div>
					</div>
             
				 </div>
				<div class="row">
				<div class="col-sm-2">
                  <div class="form-group">
                      <label>Resource url</label>
					 </div> 
					</div>
				<div class="col-sm-8">	
					   <div class="form-group">
                       <input type="text" class="form-control" id="url" name="url"  value="{{ $post['url'] }}">
                           @if ($errors->has('url'))
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    @endif
						</div>
					</div>
             
				 </div>	
				  <div class="row">   
				  <div class="col-sm-2">
                  <div class="form-group">
                    <label for="quantity">Resource Title</label>
					</div>
				</div>
				  <div class="col-sm-8">
				  <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title"  value="{{ $post['title'] }}">
                                          @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
					</div>
				</div>
				  </div>
				  <div class="row">   
				<div class="col-sm-2">
                  <div class="form-group">
                      <label>Type of resource</label>
					  </div>     
					  </div>
					    <div class="col-sm-8">
						<div class="form-group">
                      <input type="text" class="form-control" name="type"  value="{{ $post['type'] }}">
                         @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
					  </div>
					  </div>
				    </div>
				<div class="row">
				  <div class="col-sm-2">
				  <div class="form-group">
				   <label>Overview of resource</label>
				   </div>
				   </div>
				     <div class="col-sm-8">
					   <div class="form-group">
                       <input type="text" class="form-control" name="overview"  value="{{ $post['overview'] }}">
                      @if ($errors->has('overview'))
                            <span class="text-danger">{{ $errors->first('overview') }}</span>
                        @endif
						</div>
						</div>
				   </div>	    

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
              </form>
            </div>
      </div>

@endsection
@include("AdditionResource.create")