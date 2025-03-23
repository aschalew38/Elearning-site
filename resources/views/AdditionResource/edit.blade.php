<div class="modal fade" id="edit_resource" tabindex="-1" 
     role="dialog" aria-labelledby="Create additional Resource" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title m-0 " id="exampleModalScrollableTitle">Edit Resource </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div><!--end modal-header-->
            <div class="modal-body">       
              <form id="add_resource_form" action="" method="post" enctype="multipart/form-data"> 
            
                @csrf 
                <div class="mb-3 rowflex flex-col ">     

            <label  for="url" class="col-sm-2 form-label align-self-center mb-lg-0 text-end">Resource Url</label>
            <div class="col-sm-10">
            <input class="form-control" type="text"  id="url" name="url" value="{{$additional_resources_id_fetched[0]->url}}" >
            </div>
            </div>
            <div class="mb-3 rowflex flex-col ">
            <label  for="url" class="col-sm-2 form-label align-self-center mb-lg-0 text-end">Resource Title</label>
            <div class="col-sm-10">
            <input class="form-control" type="text"  id="url" name="title" value="{{old('title')}}" >
            </div>
            </div>
            <div class="mb-3">
            <label class="form-label" for="type">Select Type of the Resource</label>
            <select class="form-select" id="type" name="type">
            <option value="external">Additonal links</option>
            <option value="pdf" class="upload_resource">pdf</option>
            <option value="vedio" class="upload_resource">Vedio</option>
            </select>
            <input type="file" class="form-control my-3 d-none" id="add_resource" name="add_resource">
            </div>

            <div class="mb-3">
                <label class="form-label" for="overview">Overview of Resource</label>
                <textarea class="form-control" rows="5" id="overview" name="overview"></textarea>
            </div>
   

              </form>
           
            </div><!--end modal-body-->
            <div class="modal-footer">                                                    
                <button type="button" id="submit_form" class="btn btn-soft-primary btn-sm">Edit Resource</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
</div><!--end card-body-->
</div><!--end card-->                            
</div> <!-- end col -->  
</div><!--end row-->


@push('js')
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