<div wire:ignore.self class="modal fade" id="showContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complete DTR Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div><b>{{$fullname}} @if($dts) ({{$dts->start}} - {{$dts->end}}) @endif</b></div>
                <hr>
                <div class="table-responsive" style="font-size: 13px;">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col" class="bg-success text-white">In</th>
                            <th scope="col" class="bg-success text-white">Out</th>
                            <th scope="col" class="bg-success text-white">In</th>
                            <th scope="col" class="bg-success text-white">Out</th>
                            <th scope="col" class="bg-warning text-dark">Late in</th>
                            <th scope="col" class="bg-warning text-dark">Early out</th>
                            <th scope="col" class="bg-warning text-dark">Late in</th>
                            <th scope="col" class="bg-warning text-dark">Early out</th>
                            <th scope="col" class="bg-warning text-dark">Total (Late/early) </th>
                            <th scope="col" class="bg-primary text-white">Rate</th>
                            <th scope="col" class="bg-danger text-white">Total deduct.</th>
                            <th scope="col" class="bg-info text-dark">Total Pay</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataContents as $datass)
                            <tr>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->in)->format('(m-d-Y) h:i A') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->out)->format('h:i A') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->in2)->format('h:i A') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->out2)->format('h:i A') }}
                                    @if($datass->isEarlyOut == 1) <b style="color: white; background-color: red" class="px-2">Early out</b> @endif
                                </td>
                                <td class="p-3">
                                    {{$datass->lateIn}}
                                </td>
                                <td class="p-3">
                                    {{$datass->lateIn2}}
                                </td>
                                <td class="p-3">
                                    {{$datass->lateOut}}
                                </td>
                                <td class="p-3">
                                    {{$datass->lateOut2}}
                                </td>
                                <td class="p-3">
                                    {{$datass->totalLate}}
                                </td>
                                <td class="p-3">
                                    {{$datass->latest_total}}
                                </td>
                                <td class="p-3">
                                    {{-- Display totalDeduction here --}}
                                    {{$datass->total_deduction}}
                                </td>
                                <td class="p-3">
                                    {{-- Assuming you want to show total pay here --}}
                                    {{$datass->latest_total - $datass->total_deduction}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
