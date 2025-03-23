<div class="mb-3 rowflex flex-col ">
    <label  for="url" class="col-sm-2 form-label align-self-center mb-lg-0 text-end">Resource Url</label>
    <div class="col-sm-10">
        <input class="form-control" type="text"  id="url" name="url" value="{{old('url')}}" >
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
