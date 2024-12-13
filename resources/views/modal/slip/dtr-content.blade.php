<div wire:ignore.self class="modal fade" id="showContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complete DTR Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div><b>{{$fullname}}</b></div>
                <hr>
                <div class="table-responsive" style="font-size: 13px;">
                    <table class="table table-hover" >
                        <thead>
                        <tr>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">In</th>
                            <th scope="col">Out</th>
                            <th scope="col">Late in</th>
                            <th scope="col">Early out</th>
                            <th scope="col">Late in</th>
                            <th scope="col">Early out</th>
                            <th scope="col">Sched in</th>
                            <th scope="col">Sched out</th>
                            <th scope="col">Sched in</th>
                            <th scope="col">Sched out</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Total (Late/early) </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataContents as $datass)
                            <tr>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->in)->format('m/d/Y (h:i A)') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->out)->format('m/d/Y, (h:i A)') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->in2)->format('m/d/Y, (h:i A)') }}
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($datass->out2)->format('m/d/Y, (h:i A)') }}
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
                                    {{$datass->schedIn}}
                                </td>
                                <td class="p-3">
                                    {{$datass->schedOut}}
                                </td>
                                <td class="p-3">
                                    {{$datass->schedIn2}}
                                </td>
                                <td class="p-3">
                                    {{$datass->schedOut2}}
                                </td>
                                <td class="p-3">
                                    {{$datass->latest_total}}
                                </td>
                                <td class="p-3">
                                    @if($datass->isEarlyOut == 1) <b style="color: white; background-color: red" class="px-2">Early out</b> @endif
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
