<div wire:ignore.self class="modal fade" id="showContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Basic Salary Date Interval</h5>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
