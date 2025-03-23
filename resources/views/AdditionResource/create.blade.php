<div class="modal fade" id="create_resource" tabindex="-1" 
     role="dialog" aria-labelledby="Create additional Resource" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 " id="exampleModalScrollableTitle">Additional Resource </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">
              <form id="add_resource_form" action="{{route('additional_resources.store')}}" method="post" enctype="multipart/form-data"> 
                @csrf 
              @include("Component.forms.additional_resource_form");
              </form>
            </div><!--end modal-body-->
            <div class="modal-footer">                                                    
                <button type="button" id="submit_form" class="btn btn-soft-primary btn-sm">Add Resource</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
</div><!--end card-body-->
</div><!--end card-->                            
</div> <!-- end col -->  
</div><!--end row-->

@push("js")
<script>
$(document).ready(function(){
   $("#type").change(function(){
    if($(this).val()=='pdf'||$(this).val()=='vedio')
    {
        $("#add_resource").removeClass("d-none");
        $("#add_resource").addClass("d-block");

    }
else
   {
       $("#add_resource").removeClass("d-block");
       $("#add_resource").addClass("d-none");
   }
   });
   $("#submit_form").click(function(){

    $("#add_resource_form").submit();
});
  });
</script>  
@endpush