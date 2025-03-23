@extends('BackEnd.Layout.base')
@section('title', 'List of Catagories')
@section('content')
   

    <div class="row mt-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Digital Solution's Catagories </h4>
                    <div class="">
                         <button type="button" class="btn btn-primary btn-sm w-100 waves-effect waves-light" data-bs-toggle="modal"
        data-animation="bounce" data-bs-target=".compose-modal">
       New
    </button>
                    </div>
                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>    
                                    <th class="text-center">Actions</th>    

                                                                    </tr>
                            </thead>
                            <tbody>
                                @if ($catagories?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($catagories as $catagorie)
                                        <td class="col-md-6">{{ $catagorie->name }}</td>
                                        
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        <!--end /table-->
                    </div>
                    <!--end /tableresponsive-->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->

        <!-- end col -->
    </div>


    <div class="modal fade compose-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Digital Solution </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('catagories.store') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Catagory Name">
                            @error('name')
                                <p class="text-danger px-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end form-group-->


                        <div class="btn-toolbar form-group mb-0 float-end">
                            <button type="submit"
                                class="btn btn-soft-info btn-sm waves-effect waves-light ms-1"><span>Register</span><i
                                    class="far fa-save ms-3"></i></button>
                        </div>
                        <!--end form-group-->
                    </form>
                    <!--end form-->
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    <!--end modal-->

@endsection
