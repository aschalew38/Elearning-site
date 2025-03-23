@extends('BackEnd.Layout.base')
@section('title', 'Digital Solution')
@push('css')
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('BackEnd/plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
<table id="table"  class="table table-striped" 
  data-show-export="true"
  data-pagination="true"
  data-click-to-select="true"
  data-show-toggle="true"
  data-show-columns="true">
    
    <thead>
    <tr>
    
        <th data-field="ItemId" data-sortable="true" data-align="center">Id</th>
      <th  data-field="middlename" data-filter-control="input"  data-align="center" data-sortable="true" >Title</th>
        <th  data-field="amount" data-filter-control="input" data-align="center" data-sortable="true" >Type</th>
        <th  data-field="lastname" data-filter-control="input"  data-align="center" data-sortable="true" >Overview</th>   
       <th data-field="date"  data-sortable="true" data-class="col-sm-3" data-filter-type="datepicker_range">Date</th> 
	   <th data-field="firstname" data-filter-control="input" data-sortable="true" >Url</th>
    </tr>
    </thead>
   
        <tr class="bg-light">
            
             <td>{{$resource->id}}</td>
  
            <td>{{$resource->title}}</td>
            <td>{{$resource->type}}</td>
            <td>{{$resource->overview}}</td>
      		<td>{{$resource['created_at']}}</td>
	        <td>{{$resource->url}}</td>            
        </tr>  
</table>
@endsection
@include("AdditionResource.create")