<div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">add</button>
    <select class="form-select mt-3 mb-5" aria-label="Default select example" wire:model.live="monthView" required>
        <option value="">Select Month</option>
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
    </select>
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add top performer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submit">
                    <div class="modal-body">
                        <select class="form-select" aria-label="Default select example" wire:model="month" required>
                            <option value="">Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        @php $n=10; @endphp
                        <select class="form-select" aria-label="Default select example" wire:model="rank" required>
                            <option value="">Select Rank</option>
                            @for($x=1; $n>=$x; $x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                        </select>
                        <div class="col-5 mt-3">
                            <label  class="form-label">Agent*</label>
                            <input type="text" class="form-control" wire:model.live="fullname" wire:blur="removeSearch" required>
                            @if(session()->has('badAgent'))
                                <small style="color: #800000">Agent's name should be selected from the search suggestions.</small>
                            @endif
                            @if($showSearch == true)
                                <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                                    <ul class="list-group">
                                        @foreach($results as $datass)
                                            <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items({{$datass->id}})">
                                                <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($datass->employeeFullname)}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @error('fullname') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Sale*</label>
                            <input type="text" class="form-control" wire:model="sale" required>
                            @error('sale') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Submission*</label>
                            <input type="text" class="form-control" wire:model="submission" required>
                            @error('submission') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">QA*</label>
                            <input type="text" class="form-control" wire:model="qa" required>
                            @error('qa') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Attendance*</label>
                            <input type="text" class="form-control" wire:model="attendance" required>
                            @error('attendance') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal EDIT -->
    <div class="modal fade" wire:ignore.self id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add top performer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="submitEdit">
                    <div class="modal-body">
                        <select class="form-select" aria-label="Default select example" wire:model="month" required>
                            <option value="">Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        @php $n=10; @endphp
                        <select class="form-select" aria-label="Default select example" wire:model="rank" required>
                            <option value="">Select Rank</option>
                            @for($x=1; $n>=$x; $x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                        </select>
                        <div class="col-5 mt-3">
                            <label  class="form-label">Agent*</label>
                            <input type="text" class="form-control" wire:model.live="fullname" wire:blur="removeSearch" required>
                            @if(session()->has('badAgent'))
                                <small style="color: #800000">Agent's name should be selected from the search suggestions.</small>
                            @endif
                            @if($showSearch == true)
                                <div style="position: absolute; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.9);">
                                    <ul class="list-group">
                                        @foreach($results as $datass)
                                            <li class="list-group-item btn text-start" style="background-color: #E0FFFF;" wire:click="click_items({{$datass->id}})">
                                                <i class="fa-solid fa-magnifying-glass me-3"></i> {{ucfirst($datass->employeeFullname)}}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @error('fullname') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Sale*</label>
                            <input type="text" class="form-control" wire:model="sale" required>
                            @error('sale') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Submission*</label>
                            <input type="text" class="form-control" wire:model="submission" required>
                            @error('submission') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">QA*</label>
                            <input type="text" class="form-control" wire:model="qa" required>
                            @error('qa') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-5 mt-3">
                            <label class="form-label">Attendance*</label>
                            <input type="text" class="form-control" wire:model="attendance" required>
                            @error('attendance') <span style="color: #8B0000">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{$monthView}}
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Rank</th>
            <th scope="col">Full Name</th>
            <th scope="col">Sale</th>
            <th scope="col">Submission</th>
            <th scope="col">QA</th>
            <th scope="col">Attendance</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
            <tr>
                <td>{{$datas->rank}}</td>
                <td>{{$datas->fullname}}</td>
                <td>{{$datas->sale}}</td>
                <td>{{$datas->submission}}</td>
                <td>{{$datas->qa}}</td>
                <td>{{$datas->attendance}}</td>
                <td><i class="fa-solid fa-pen-to-square" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#edit" wire:click="edit({{$datas->id}})"></i></td>
                <td><i class="fa-solid fa-trash" style="color: red; cursor: pointer" data-bs-toggle="modal" data-bs-target="#delete" wire:click="delete({{$datas->id}})"></i></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
