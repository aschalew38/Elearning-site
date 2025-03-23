@extends('BackEnd.Layout.base')
@section('title', 'Dashboard')
@section('content')
    {{-- @dd($user) --}}
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if (Auth::user()->profile)
                                    <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Photo" class="rounded-circle p-1 bg-primary" width="100px" height="100px">
                                @else
                                    <div class="rounded-circle p-1 bg-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        {{-- <span>user</span> --}}
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    @foreach (Auth::user()->roles as $role)
                                        <span class="badge rounded-pill bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <hr class="my-4">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ Auth::user()?->name }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ Auth::user()?->email }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ Auth::user()?->phone }}</div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary"> {{ Auth::user()?->username }}</div>
                            </div>
                            <hr>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <h5>Edit</h5>
                    <form action="{{ route('User.update', ['User' => Auth::user()?->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">

                                <div class="col-md-2 mx-auto">
                                    <div class="form-group row d-flex flex-column">
                                        <label for="name" class=" col-form-label"
                                            style="text-align: center">Photo</label>
                                        <div class="col-sm-11 border-1">
                                            <div id="imagePreview" class="col-md-2 my-1"></div>
                                            <input type="file" id="imageInput" name="photo" accept="image/*"
                                                class="col-md-11" onchange="previewImage(event)">

                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary"> <input type="text" name="name"
                                            value="{{ Auth::user()->name }}" class="form-control"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary"> <input type="text" name="email"
                                            class="form-control" value="{{ Auth::user()->email }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="username"
                                            value="{{ Auth::user()->username }}">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ Auth::user()->phone }}">

                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="update Changes">
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                @if ($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                </form>
            </div>
        </div>
    @endsection
    @push('js')
        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('imagePreview');
                    output.innerHTML = '<img src="' + reader.result + '" alt="Photo" width="150px" height="150px"> ';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @endpush
