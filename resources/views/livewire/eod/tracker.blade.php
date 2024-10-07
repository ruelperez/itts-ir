<div>
    <div>
        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            {{$campaignName}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="/eod/masstort-tracker">Mass Tort</a></li>
            <li><a class="dropdown-item" href="/eod/dtv-tracker">Direct TV</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="px-2 py-2 mt-3" style="background-color: #696969; color: white; border-radius: 10px;">
            @livewire('eod.'.$subject.'.sales-report',['pages' => $pages])
        </div>
        <div class="px-2 py-2 mt-3" style="background-color: #696969; color: white; border-radius: 10px;">
            @livewire('eod.'.$subject.'.submission-report',['pages' => $pages])
        </div>
        <div class="px-2 py-2 mt-3" style="background-color: #696969; color: white; border-radius: 10px;">
            @livewire('eod.'.$subject.'.employee-sales-report',['pages' => $pages])
        </div>
    </div>
    @script
    <script>
        $wire.on('error', () => {
            Swal.fire({
                title: 'Failed',
                text: 'End date must be greater than or equal to start date',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endscript
</div>
