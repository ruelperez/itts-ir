@include('modal.click-lead')
{{--@include('modal.click-settings')--}}
    <!-- Sidebar -->
    <aside id="sidebar" class="position-fixed vh-100">
        <div>
            <div class="sidebar-logo mb-3 text-center">
                <div>
                    <img src="{{asset('photo/logo-banner.png')}}" width="150">
                </div>
            </div>
{{--            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show_photo" id="show_photo" hidden>--}}
{{--                Launch demo modal--}}
{{--            </button>--}}
{{--            <div style="text-align: center; margin-top: 5%;width: 100%;">--}}
{{--                <div style="display: flex;">--}}
{{--                    @if($position != "Agent")--}}
{{--                        <i onclick="clickEllipsis()" class="fa-solid fa-ellipsis-vertical" id="ellip" style="color: white; margin-left: 10%;font-size: 23px; cursor: pointer; margin-right: 11%;"></i>--}}
{{--                    @endif--}}
{{--                    <div class="profile" style="@if($position == "Agent") margin-left: 22%; @endif">--}}
{{--                        <img src="{{asset('photos/photos/'.$photo)}}" alt="Profile Picture">--}}
{{--                        <div style="background-color:#C0C0C0; position: absolute; top: 70%; left: 65%; border-radius: 80%; padding: 1%; width: 20%; cursor: pointer" onclick="chooseFile()">--}}
{{--                            <i class="fa-solid fa-camera" style="font-size: 17px;"></i>--}}
{{--                            <input type="file" id="fileInput" accept="image/*" hidden wire:model.live="photo">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <h6 style="color: white;">@if($employeeData == null or $employeeData == "") @else {{$employeeData}} @endif</h6>--}}
{{--                <p class="text-white">{{ucwords($fullname)}}<br><small class="user-select-all">ITTS-00{{$user_id}}</small></p>--}}
{{--            </div>--}}
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
{{--                    <div class="card border border-0">--}}
{{--                        <div class="card-body text-center">--}}
{{--                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"--}}
{{--                                 class="rounded-circle img-fluid" style="width: 80px;">--}}
{{--                            <h6 class="my-2">{{ucwords($fullname)}}</h6>--}}
{{--                            <p class="mb-1 "><small>@if($employeeData == null or $employeeData == "") @else {{$employeeData}} @endif</small></p>--}}
{{--                            <p><small>ITTS-00{{$user_id}}</small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="d-flex align-items-center ps-3">
                        <div class="flex-shrink-0 text-center prof_pic">
                            <img src="{{asset('photos/photos/'.$photo)}}"
                                 alt="Generic placeholder image" class="img-fluid rounded-circle border border-dark border-3"
                                 style="width: 70px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-0 me-1">{{ucwords($fullname)}}</p>
                            <p class="mb-0 me-1 text-muted"><small>@if($employeeData == null or $employeeData == "") @else {{$employeeData}} @endif</small></p>
                            <p class="mb-0 me-1 text-muted user-select-all"><small>ITTS-00{{$user_id}}</small></p>
                        </div>
                    </div>
                    <div class="text-center" style="width: 28%; margin-left: 6%;">
                        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" id="profile-upload-form">
                            @csrf
                            <input type="file" name="profile_picture" id="profile-picture-input" style="display: none;" onchange="handleFileUpload()">
                            <!-- Camera Icon -->
                            <i class="fas fa-camera camera-icon" onclick="document.getElementById('profile-picture-input').click()" style="cursor: pointer"></i>
                        </form>
                        <!-- Loading Spinner -->
                        <div class="spinner-border" id="loading-spinner" role="status" style="display: none">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="text-end pe-3 mt-3">
                        <p><small style="cursor: pointer" onclick="location.href = '/user/logout';" x-data="{ hover: false }"
                                  x-on:mouseover="hover = true"
                                  x-on:mouseleave="hover = false"
                                  :class="hover ? 'text-info' : 'text-primary'"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Log Out</small></p>
                    </div>
                </li>
                <div class="scrollable-div">
                    <li class="sidebar-item ps-4">
                        <small>Tools & Components</small>
                    </li>
                    <li class="sidebar-item">
                        <a href="/dashboard"  class="sidebar-link">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/employee-dtr"  class="sidebar-link">
                            <i class="fa-solid fa-business-time pe-2"></i>
                            DTR
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                           aria-expanded="false" aria-controls="pages">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            Campaign
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/mass-tort" class="sidebar-link">Mass Tort</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">DTV</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Home Security</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="/production-lead-mass-tort"  class="sidebar-link">
                            <i class="fa-solid fa-money-bill pe-2"></i>
                            Prod. Leads
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/employee"  class="sidebar-link">
                            <i class="fa-regular fa-user pe-2"></i>
                            Employee
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/my-device"  class="sidebar-link">
                            <i class="fa-solid fa-laptop pe-2"></i>
                            My Device
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/notes"  class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Notes
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/link-form"  class="sidebar-link">
                            <i class="fa-solid fa-share-nodes pe-2"></i>
                            Form Link
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/faq"  class="sidebar-link">
                            <i class="fa-solid fa-question pe-2"></i>
                            FAQ
                        </a>
                    </li>
                    <li class="sidebar-item ps-4 mt-2">
                        <div class="dropup">
                            <a class="dropdown-toggle" id="dropupLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>Admin access</small>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropupLink">
                                <a class="dropdown-item" href="/logs"><i class="fa-solid fa-tent-arrow-left-right pe-2"></i>
                                    Logs</a>
                                <a class="dropdown-item" href="/eod/masstort-tracker"><i class="fa-solid fa-universal-access pe-2"></i>
                                    EOD</a>
                                <a class="dropdown-item" href="/inventory"><i class="fa-solid fa-store pe-2"></i>
                                    Inventory</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#lead"><i class="fa-solid fa-check-to-slot pe-2" ></i>
                                    Lead Tracker</a>
                                <a class="dropdown-item" href="/settings"><i class="fa-solid fa-gear pe-2"></i>
                                    Settings</a>
                            </div>
                        </div>
                    </li>
                </div>
{{--                <li class="sidebar-item">--}}
{{--                    <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi"--}}
{{--                       aria-expanded="false" aria-controls="multi">--}}
{{--                        <i class="fa-solid fa-share-nodes pe-2"></i>--}}
{{--                        Multi Level--}}
{{--                    </a>--}}
{{--                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">--}}
{{--                        <li class="sidebar-item">--}}
{{--                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"--}}
{{--                               data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">--}}
{{--                                Two Links--}}
{{--                            </a>--}}
{{--                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">--}}
{{--                                <li class="sidebar-item">--}}
{{--                                    <a href="#" class="sidebar-link">Link 1</a>--}}
{{--                                </li>--}}
{{--                                <li class="sidebar-item">--}}
{{--                                    <a href="#" class="sidebar-link">Link 2</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </div>
    </aside>


