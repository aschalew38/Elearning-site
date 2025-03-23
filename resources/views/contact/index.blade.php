@extends('BackEnd.Layout.base')
@section('title', 'Messages from Users')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    @php
        use App\Constants;
    @endphp
    @if (session()->has('success'))
        <div class="alert alert-outline-success alert-dismissible d-flex align-items-center col-md-8 mb-0" role="alert">
            <i class="ti ti-checks alert-icon me-2"></i>
            <div>
                <strong>{{ session('success') }}</strong>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method='POST' id="deleteForm">@csrf @method('DELETE')</form>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">List of Messages</h4>

                </div>
                <!--end card-header-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="">User</th>
                                    <th class="">Email</th>
                                    <th class="col-md-2">Subject</th>
                                    <th class="col-md-7">Message</th>
                                    <th class="text-end">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($contacts?->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center">No records Found</td>
                                    </tr>
                                @else
                                    @foreach ($contacts as $contact)
                                        <td class="col-md-1 align-text-top">{{ $contact->name }}</td>
                                        <td class="col-md-1 align-text-top">{{ $contact->email }}</td>
                                        <td class="col-md-2 align-text-top">{{ $contact->subject }}</td>
                                        <td class="col-md-7 text-justify">

                                                    {{ $contact->message }}

                                        </td>

                                        <td class="align-text-top text-end">

                                                    {{ \Carbon\Carbon::parse($contact->created_at)->format('d, M Y H:i') }}
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="px-5 py-2 d-flex justify-content-end">
                            @if (method_exists($contacts, 'links'))
                                {{ $contacts->links() }}
                            @endif
                        </div>
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
@endsection
@push('js')
    <script src="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        function deleteForm(route) {
            swal.fire({
                title: "Are you sure?",
                text: "Are Sure delete!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    $('#deleteForm').attr('action', route);
                    $('#deleteForm').submit();
                }
            });

        }
    </script>
@endpush
