@extends("Front.Layout.base")
@section("title","Digital Solutions")
@section("content")

<div class="row col-md-10 mx-auto my-4" style="min-height: 60vh;">
<div class="card ">
    <div class="card-header">
        <h4 class="card-title">Additional Resources</h4>
        <p class="text-muted mb-0">pdf and vedios resources</p>
    </div><!--end card-header-->
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th scope="col col-md-6">title</th>
                        <th scope="col col-md-6">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($additional_resources as $adr)
                    <tr>
                        <td class="col-md-2">
                            {{ $adr->title }}
                        </td>
                        {{-- <td class="col-md-6 text-start">{{$adr->overview}}</td> --}}
                        <td class="col-md-7 px-4" style="text-align: justify">
                            {{$adr->overview}}
                            <p>
                                @if($adr->type=="external")
                                <a href='{{$adr->url}}' target="_blank">
                                    For more information ...
                                </a>
                                @else
                                <a href="{{asset("storage/".$adr->url)}}" target="_blank">For more information ...</a>
                                @endif
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table><!--end /table-->
        </div><!--end /tableresponsive-->
    </div><!--end card-body-->
</div>
</div>
@endsection

