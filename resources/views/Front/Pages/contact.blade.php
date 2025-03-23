@extends('Front.Layout.base')
@section('title', 'Contact form')
@section('content')
@if(session()->has("success"))
<div class="alert alert-outline-success alert-dismissible d-flex align-items-center mb-0"  style="margin-bottom:60%;" role="alert">
    <i class="ti ti-checks alert-icon me-2"></i>
    <div class="mb-4">
        <strong>Well done!</strong> Thank Your comment and/or Question.
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
    <div class="col-lg-6 mx-auto my-4">
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Leave You Message</h4>
                <p class="text-muted mb-0">Comment and/or Question</p>
            </div><!--end card-header-->
            <div class="card-body mb-4">
                <form class="" action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required="">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required="">
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                    value="{{ old('subject') }}" required="">
                            </div>
                            @error('subject')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="message">Message</label>
                                <textarea class="form-control" rows="5" id="message" name="message"></textarea>
                            </div>
                        </div>
                        @error('message')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">Send Message</button>
                        </div>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->


    </div>
@endif
@endsection
