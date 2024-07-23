<div>
    @include('components.layouts.profile')
    @include('components.layouts.navigation')
    @include('modal.click-settings')
    @include('modal.news-update.show-photo')
    @include('modal.employee.loading')
    @include('modal.employee.disclick')
    <div style="display: flex; width: 100%; margin-top: 105px; ">
        <div style="width: 81%; margin-left: 19%;">
            <div>
                <div style="display: flex;" class="align-items-center">
                    <div class="w-50 ps-4 mt-4">
                        <h6>EMPLOYEE</h6>
                    </div>
                    @if($position == "Super Admin")
                        <div class="w-50 mt-4 text-end pe-5">
                            <button class="btn btn-primary" style="width: 40%;" onclick="location.href = '/itts/16/staff-directory';"><i class="fa-solid fa-arrows-to-circle me-2" ></i>Staff Directory</button>
                        </div>
                    @endif
                </div>
                <hr>
                <div>
{{--                    <div wire:loading class="spinner-border spin" style="height: 55px; width: 55px; margin-left:47%; margin-top:10%; color: black">--}}
{{--                        <span class="visually-hidden" style="color: black">Loading...</span>--}}
{{--                    </div>--}}
                    <form wire:submit.prevent="submitForm" class="px-5 pt-1 pb-5" >
                        <fieldset @if($is_success == true) disabled @endif>
                            <div class="mb-2"><i>Put n/a if not applicable</i></div>
                            <div class="row g-3 align-items-center">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">First Name</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="fname" title="{{ucwords($fname)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Middle Name</label>
                                    </div>
                                    <div >
                                        <input type="text"  class="form-control" wire:model="mname" title="{{ucwords($mname)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">M.I</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="mi" title="{{ucwords($mi)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Last Name</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="lname" title="{{ucwords($lname)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Suffix</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="suffix" title="{{ucwords($suffix)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Age</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="age" title="{{ucwords($age)}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Phone Number</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="phone_number" title="{{ucwords($phone_number)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Date of Birth</label>
                                    </div>
                                    <div >
                                        <input type="text" id="date-input" placeholder="mm/dd/yyyy"  class="form-control" wire:model="dob" title="{{ucwords($dob)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Gender Preference</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="gender_preference" title="{{ucwords($gender_preference)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Civil Status</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="civil_status" title="{{ucwords($civil_status)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Religion</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="religion" title="{{ucwords($religion)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Personal Email</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="personal_email" title="{{$personal_email}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Current Address :</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">House/Apartment/Floor</label>
                                    </div>
                                    <div >
                                        <input type="text"  class="form-control" wire:model="current_house" title="{{ucwords($current_house)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Street Name</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="current_street" title="{{ucwords($current_street)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Baranggay</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="current_brgy" title="{{ucwords($current_brgy)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">City</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="current_city" title="{{ucwords($current_city)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Working Email</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="current_working_email" title="{{ucwords($current_working_email)}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model.live="same_current_permanent" value="{{$same_current_permanent}}" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Your current address is the same as you Permanent Address?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Permanent Address :</label>
                                    </div>

                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">House/Apartment/Floor</label>
                                    </div>
                                    <div >
                                        <input type="text"  class="form-control" wire:model="permanent_house" title="{{ucwords($permanent_house)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Street Name</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="permanent_street" title="{{ucwords($permanent_street)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Baranggay</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="permanent_brgy" title="{{ucwords($permanent_brgy)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">City</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="permanent_city" title="{{ucwords($permanent_city)}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-2">

                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">SSS Number</label>
                                    </div>
                                    <div >
                                        <input type="text"  class="form-control" wire:model="sss" title="{{ucwords($sss)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Phil Health Number</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="philhealth" title="{{ucwords($philhealth)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">TIN Number</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="tin" title="{{ucwords($tin)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Hire Date</label>
                                    </div>
                                    <div>
                                        <input type="text" id="hire-date" class="form-control" wire:model="hire_date" title="{{ucwords($hire_date)}}" placeholder="mm/dd/yyyy" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Years of Tenure</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="yot" title="{{ucwords($yot)}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-4">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Status :</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Department</label>
                                    </div>
                                    <div>
                                        <select class="form-select" aria-label="Default select example" wire:model.live="department" required>
                                            <option value="Management">Management</option>
                                            <option value="Admin">Admin </option>
                                            <option value="Admin - Production">Admin - Production</option>
                                            <option value="Admin - Back Office">Admin - Back Office</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if($department == "Management")
                                        <div>
                                            <label class="col-form-label">Designation / Position</label>
                                        </div>
                                        <div>
                                            <select class="form-select" aria-label="Default select example" wire:model="designation">
                                                <option selected value="Chief Executive Officer">Chief Executive Officer</option>
                                                <option value="President">President</option>
                                            </select>
                                        </div>
                                    @elseif($department == "Admin")
                                        <div>
                                            <label class="col-form-label">Designation / Position</label>
                                        </div>
                                        <div>
                                            <select class="form-select" aria-label="Default select example" wire:model="designation">
                                                <option selected value="Accounts and Back Office Manager">Accounts and Back Office Manager</option>
                                                <option value="Production Floor Manager/ Process Lead">Production Floor Manager/ Process Lead</option>
                                                <option value="Human Resource Officer">Human Resource Officer</option>
                                            </select>
                                        </div>
                                    @elseif($department == "Admin - Production")
                                        <div>
                                            <label class="col-form-label">Designation / Position</label>
                                        </div>
                                        <div>
                                            <select class="form-select" aria-label="Default select example" wire:model="designation">
                                                <option selected value="Agent / Sale Associate">Agent/ Sale Associate</option>
                                                <option value="Senior Team Leader">Senior Team Leader</option>
                                                <option value="Team Leader">Team Leader</option>
                                                <option value="Subject Matter Expert">Subject Matter Expert</option>
                                                <option value="Receptionist">Receptionist</option>
                                            </select>
                                        </div>
                                    @elseif($department == "Admin - Back Office")
                                        <div>
                                            <label class="col-form-label">Designation / Position</label>
                                        </div>
                                        <div>
                                            <select class="form-select" aria-label="Default select example" wire:model="designation">
                                                <option selected value="Quality Assurance">Quality Assurance</option>
                                                <option value="Recording & Editor">Recording & Editor </option>
                                                <option value="BO - IT">BO - IT</option>
                                                <option value="Retainer">Retainer</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Site</label>
                                    </div>
                                    <div>
                                        <select class="form-select" aria-label="Default select example" wire:model="branch">
                                            <option value="mindoro">Mindoro</option>
                                            <option value="bicol">Bicol</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 align-items-center mt-4 mb-4">
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Emergency Contact :</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Fullname</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="full_name" title="{{ucwords($contact_number)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Contact Number</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="contact_number" title="{{ucwords($contact_number)}}" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <label class="col-form-label">Address</label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="address" title="{{ucwords($address)}}" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="col-form-label">Relationship </label>
                                    </div>
                                    <div>
                                        <input type="text"  class="form-control" wire:model="relationship" title="{{ucwords($relationship)}}" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row align-items-center mb-3 position-fixed bottom-0 w-75" >
                            <div class="col-4">

                            </div>
                            @if($is_success == true)
                                <div class="col-4">
                                    <button type="button" class="btn btn-warning" style="width: 100%;  box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); " id="submitButton" wire:click="updateForm" wire:loading.attr="disabled">UPDATE
                                        <div class="spinner-border spinner-border-sm ms-5" role="status" style="display: none">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            @else
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary" style="width: 100%; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9); " wire:target="submitForm" wire:loading.attr="disabled">SAVE

                                    </button>
                                </div>
                            @endif
                            <div class="col-4">

                            </div>
                        </div>
                    </form>
                </div>
<button id="btn1" data-bs-toggle="modal" data-bs-target="#loading" style="display: none"></button>
            </div>
        </div>
    </div>
    @include('partial.header')
        @script
        <script>
            $wire.on('formSubmitted', () => {
                $('#btn1').click();
            });
        </script>
        @endscript
</div>

