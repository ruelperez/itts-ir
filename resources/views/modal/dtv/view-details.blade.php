<div wire:ignore.self class="modal fade" id="viewDetail">
    <div class="modal-dialog">
        <div class="modal-content pb-3" >
            <div class="modal-header">
                <h5 class="modal-title">{{ucfirst($customer)}} ({{$phoneNumber}})</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="formClose" aria-label="Close"></button>
            </div>
            <div class="text-center">
                <div class="spinner-border mt-3" role="status" wire:loading>
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="ms-3 mt-3"  wire:loading.remove>
                <div>
                    <p>Date: <b>{{ucfirst($date)}}</b></p>
                </div>
                {{--                <div>--}}
                {{--                    <p>Source: <b>{{ucfirst($source)}}</b></p>--}}
                {{--                </div>--}}
                <div>
                    <p>Agent: <b>{{ucfirst($agent)}}</b></p>
                </div>
                <div>
                    <p>Coach: <b>{{ucfirst($coach)}}</b></p>
                </div>
                <hr>
                <div>
                    <p>Customer: <b>{{ucfirst($customer)}}</b></p>
                </div>
                <div>
                    <p>Phone #: <b>{{$phoneNumber}}</b></p>
                </div>
                <div>
                    <p>Alt. Phone #: <b>{{$altPhoneNumber}}</b></p>
                </div>
                <div>
                    <p>Email: <b>{{$email}}</b></p>
                </div>
                <div>
                    <p>Address: <b>{{$address}}</b></p>
                </div>
                <hr>
                <div>
                    <p>Service: <b>{{$service}}</b></p>
                </div>
                <div>
                    <p>Package: <b>{{$package}}</b></p>
                </div>
                <div>
                    <p>Order #: <b>{{$orderNumber}}</b></p>
                </div>
                <div>
                    <p>Disposition: <b>{{$disposition}} - {{$description}}</b></p>
                </div>
                <div>
                    <p>Result: <b>{{$result}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
