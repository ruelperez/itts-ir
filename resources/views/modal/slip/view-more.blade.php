<div wire:ignore.self class="modal fade" id="view_more" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$content_name}} (Deduction & Work Schedule)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="font-size: 13px;">
                    @if ($addtional)
                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th scope="col" class="bg-warning">Early/late deduct.</th>
                                <th scope="col" class="bg-warning">SSS</th>
                                <th scope="col" class="bg-warning">Philhealth</th>
                                <th scope="col" class="bg-warning">CA</th>
                                <th scope="col" class="bg-warning">Total Deduction</th>
                                <th scope="col" class="bg-success text-white" >Sched in</th>
                                <th scope="col" class="bg-success text-white">Sched out</th>
                                <th scope="col" class="bg-success text-white">Sched in</th>
                                <th scope="col" class="bg-success text-white">Sched out</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-3">
                                        {{$addtional->salary_deduction->lateDeduction}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->salary_deduction->sss}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->salary_deduction->ph}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->salary_deduction->ca}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->salary_deduction->totalDeduction}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->schedIn}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->schedOut}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->schedIn2}}
                                    </td>
                                    <td class="p-3">
                                        {{$addtional->schedOut2}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>No data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
