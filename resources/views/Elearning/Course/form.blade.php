 <div class="row mt-2">
     <div class="col-lg-10 mx-auto px-3">
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title">New Course Registration</h4>
             </div>
             <div class="card-body">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <label class="form-label" for="name">Name</label>
                             <input type="text" name="name" class="form-control"
                                 value="{{ old('name')??$course ? $course->name : 'Course Name' }}" id="name"
                                 required="">
                         </div>
                         @error('name')
                             <p class="text-danger px-4">{{ $message }}</p>
                         @enderror
                     </div>
                     <div class="col-md-6">
                         <label class="mb-1">Catagory</label>
                         <select name="catagory"
                             class="select2 form-control mb-3 custom-select select2-hidden-accessible"
                             style="width: 100%;" tabindex="-1" aria-hidden="true">
                             @if ($course)

                             @endif
                             <option>Select</option>
                             <option value="Web Development" {{$course?->catagory=="Web Development"?'selected':''}}>Web Development</option>
                             <option value="Data Science" {{$course?->catagory=="Data Science"?'selected':''}}>Data Science</option>
                             <option value="Mobile Application Development" {{$course?->catagory=="Mobile Application Development"?'selected':''}}>Mobile Application Development</option>
                             <option value="Programming Languages" {{$course?->catagory=="Programming Languages"?'selected':''}}>Programming Languages</option>
                             <option value="Database Design and Development" {{$course?->catagory=="Database Design and Development"?'selected':''}}>Database Design and Development</option>
                         </select>
                         @error('catagory')
                             <p class="text-danger px-4">{{ @message }}</p>
                         @enderror
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-3">
                         <div class="mb-3">
                             <label class="form-label" for="price">Price</label>
                             <input type="number" step="0.1" name="price" class="form-control"
                                 value="{{ old('price')??$course ? $course->price : 'Price' }}" id="title" required="">
                         </div>
                         @error('price')
                             <p class="text-danger px-4">{{ $message }}</p>
                         @enderror



                     </div>
                     <div class="col-md-3">
                         <div class="mb-3">
                             <label class="form-label" for="minutes">Total time in Minutes</label>
                             <input type="number" name="minutes" class="form-control"
                                 value="{{old('minutes')?? $course ? $course->minutes : '0' }}" id="minutes" required="">
                         </div>
                         @error('minutes')
                             <p class="text-danger px-4">{{ @message }}</p>
                         @enderror

                     </div>

                 </div>
                 <hr class="dashed">
                 <div class="row">
                     <div class="col-md-6">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Course Overview</h4>
                             </div>
                             <div class="card-body">
                                 <textarea class="form-control"  rows="10" name="overview"
                                     id="overview">{{ $course ? $course->overview : '' }}</textarea>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-5">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Poster</h4>
                             </div>
                             <!--end card-header-->
                             <div class="card-body">
                                 <input type="file" id="poster" name="poster" class="dropify"
                                     data-height="300" />
                             </div>
                         </div>

                         <hr class="dashed">
                     </div>
                 </div>
             </div>

             <div class="d-flex justify-content-end mb-4 mx-4">

                 <button type="submit" class="btn btn-primary">Submit</button>
             </div>
         </div>
     </div>

 </div> <!-- end col -->

 </div>
