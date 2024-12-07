<div>
    <div class="row mb-4">
        <div class="mb-3 col-sm-4 col-md-2 col-lg-3 col-xl-2">
            <select wire:model.live="status" id="status" class="form-control w-100">
                <option value="all">All</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <!-- Search Bar -->
        <div class="mb-3 col-sm-8 col-md-6 col-lg-5 col-xl-5">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search by fullname"
                class="form-control w-100"
            />
        </div>
        <div class="col-sm-5 col-md-4 col-lg-3 ms-auto">
            <button type="button " class="btn btn-warning w-100">Add salary statement</button>
        </div>
    </div>
<hr>
    <div class="table-responsive mt-3" style="font-size: 15px;">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-xl-5">Full name</th>
                <th>Daily rate</th>
                <th>Status</th>
                <th>Pay slip</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                @foreach ($user->employee as $directory)
                    <tr>
                        <td>
                            <a href="/admin-access/salary/record/{{ $user->id }}" style="cursor: pointer; text-decoration: none; color: inherit;" onmouseover="this.style.color='blue'; this.style.textDecoration='underline';"
                               onmouseout="this.style.color='black'; this.style.textDecoration='none';">
                                {{ $user->fullname }}
                            </a>
                        </td>
                        <td>
                            {{ $directory->dailyRate ? $directory->dailyRate : 'n/a' }}
                        </td>
                        <td class="col-lg-2">
                            @if($directory->status == 1) <button style="background-color: #C4FFB8; color: darkgreen; border: none">Active</button> @elseif($directory->status == 0) <button style="background-color: #FFCFCF; color: red; border: none">Inactive</button> @else {{$directory->status}} @endif
                        </td>
                        <td>
                            <i class="fa-regular fa-rectangle-list" style="cursor: pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="3">No users found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
