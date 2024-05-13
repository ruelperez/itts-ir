<div wire:ignore.self class="modal fade" id="setTime" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 300px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Set shift schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-outline mb-4">
                    <div>
                        <label class="form-label" for="form3Example3cg" style="margin-right: 3%;">Lunch out</label>
                        <select wire:model="selectedHour">
                            @for ($hour = 0; $hour <= 12; $hour++)
                                <option value="{{sprintf('%02d', $hour)}}">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select wire:model="selectedMinute">
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{sprintf('%02d', $minute)}}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select wire:model="selectedPeriod" style="margin-right: 3%;">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>
                        @if(isset($timeSched)) {{$timeSched->out}} @endif
                    </div>
                    <div style="margin-top: 3%;">
                        <label class="form-label" for="form3Example3cg" style="margin-right: 3%;">Lunch in (after lunch)</label>
                        <select wire:model="selectedHour2">
                            @for ($hour = 0; $hour <= 12; $hour++)
                                <option value="{{ $hour }}">{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select wire:model="selectedMinute2">
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{ $minute }}">{{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                        <select wire:model="selectedPeriod2" style="margin-right: 3%;">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>
                        @if(isset($timeSched)) {{$timeSched->out2}} @endif
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                @if(session()->has('goodSched'))
                    <div class="alert alert-success" style="width: 100%; " wire:ignore>
                        {{ session('goodSched') }}
                    </div>
                @elseif(session()->has('badSched'))
                    <div class="alert alert-danger" style="width: 100%; " wire:ignore>
                        {{ session('badSched') }}
                    </div>
                @endif
                @if(session()->has('goodSched'))
                    <div style="display: none">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitWeek">Submit</button>
                    </div>
                @else
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="submitSched" wire:confirm="Are you sure you want to reset weekly DTR?">Submit</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
