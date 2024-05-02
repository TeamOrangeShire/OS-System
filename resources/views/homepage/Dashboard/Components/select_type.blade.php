<div class="modal fade" id="selectType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title" id="staticBackdropLabel">Finish Account Set up</h1>

        </div>
        <div class="modal-body">
          <form id="typeChange">
            @csrf
            
            <input type="hidden" value="{{ $user_id }}" name="cust_id">
            <input type="hidden" name="type" id="customerTypeSelected">
          </form>
        <div id="selectionPhase">
          <h1 class="fs-4">Select Customer Type: </h1>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#student_select" aria-expanded="false" aria-controls="flush-collapseOne">
                  Student 
                </button>
              </h2>
              <div id="student_select" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><i>Note: If you select Student under Educational Sector, you'll be required to submit or present a photo of your valid Student ID for verification purposes only.</i>
                <br><button onclick="SelectType('Student', '{{ route('UpdateType') }}')" class="btn btn-primary mt-4">Select Student</button> 
                </div>

              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#teacher_select" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Teacher
                </button>
              </h2>
              <div id="teacher_select" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><i>Note: If you select Teacher under Educational Sector, you'll be required to  or present a photo of your valid ID of your employment as a Teacher in a school for verification purposes only.</i>
                  <br><button onclick="SelectType('Teacher', '{{ route('UpdateType') }}')" class="btn btn-primary mt-4">Select Teacher</button>  
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reviewer_select" aria-expanded="false" aria-controls="flush-collapseThree">
                  Reviewer
                </button>
              </h2>
              <div id="reviewer_select" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><i>Note: If you select Reviewer under Educational Sector, you'll be required to submit a photo of your valid ID for verification purposes only.</i>
                  <br><button onclick="SelectType('Reviewer', '{{ route('UpdateType') }}')" class="btn btn-primary mt-4">Select Reviewer</button>  
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#professional_select" aria-expanded="false" aria-controls="flush-collapseThree">
                 Professional/Regular
                </button>
              </h2>
              <div id="professional_select" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body"><i>Note! No Verification process for this customer type and regular charges will be apply to all of your transaction</i></div>
                <br><button onclick="SelectType('Regular/Professional', '{{ route('UpdateType') }}')" class="btn btn-primary mt-4">Select Regular/Professional</button> 
              </div>
            </div>
          
          </div>
        </div>
  
        <div id="decidingPhase" style="display:none">
          <button onclick="BackTo('selectionPhase', 'decidingPhase')" type="button" class="btn fs-3 mb-3"><i class="bi bi-arrow-left"></i>Back</button>
           <p>To verify your account type, please upload a valid ID. Customers associated with educational sectors enjoy discounts at Orange Shire. For educational sector accounts, please upload your school or student ID, or PRC exam permit. Alternatively, you can present these documents during your visit to Orange Shire.</p>
           <br>
           <h3>Account Type: <span id="spanTypeHolder"></span></h3>
           <p>Visit Orange Shire: Your account will temporarily be designated as a Professional/Regular Account, with your request pending until confirmation by our staff during your visit to Orange Shire.</p>
           <button onclick="UpdateSelection('{{ route('UpdateType') }}')" class="btn btn-primary">Visit Orange Shire</button>
           <br><br>
           <p>Upload Photo: Your uploaded photo will be securely transmitted to Orange Shire's administrators for verification. While your verification is in progress, you can continue to use the app. Please note that the verification process may take some time. Thank you for your patience and cooperation.</p>
           <button onclick="UploadingPhase()" class="btn btn-primary">Upload Photo</button>
          </div>
        <div id="uploadingPhase" style="display: none">
          <button  onclick="BackTo('decidingPhase', 'uploadingPhase')" type="button" class="btn fs-3 mb-3"><i class="bi bi-arrow-left"></i>Back</button>
        <p>After uploading, please note that the verification process may take some time for confirmation. You can start using the app immediately, but the Education Sector discount will not be applied until your verification request is approved.</p>
            <h2 class="fs-3">Students(Upload Photo)</h2>
            <div class="rounded mx-auto p-4 container border border-dark-subtle row text-center">
               <img id="previewImg" src="{{ asset('customer_dashboards/img/id_placeholder.png') }}" alt="placeholder" class="w-100 col-md-12">
               <p>Upload the front part of your ID where your picture and names are capture it very clearly</p>
            </div>
            <div class="d-flex row container mt-4">
              <form id="uploadedFile" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="col-sm-12">
                <label for="formFile">Upload your Picture</label>
                <input type="hidden" name="cust_id" value="{{$user_id}}">
                <input type="hidden" id="upload_cust_type" name="type">
                <input class="form-control" onchange="previewImage(this, 'previewImg')" type="file" accept="image/*" name="id_photo" id="formFile">
                <button type="button" onclick="uploadPhoto('{{route('UploadVerificationPhone')}}')" class="btn btn-primary mt-4">Submit Photo</button>
              </div>
            </form>
           </div>
        </div>

        </div>
        <div class="modal-footer">
          <p>Complete the set up to start using your account</p>
          {{-- <button type="button" class="btn btn-primary">Confirm Set Up</button> --}}
        </div>
      </div>
    </div>
  </div>