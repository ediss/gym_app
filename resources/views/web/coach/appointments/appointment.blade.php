<div class="col mt-3">

    @foreach($appointments as $appointment)
    <div class="card radius-10 border-0 border-start {{$appointment->status === 'started' ? 'border-warning' : 'border-danger'}} border-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="">
                    <p class="mb-1">{{$appointment->appointment_start}}</p>
                    <h4 class="mb-0 text-warning">{{$appointment->client_name}}</h4>
                </div>

                <div class="ms-auto">
                    <a href="{{route('appointment.start', ['id' => $appointment->id])}}" class="btn btn-outline-{{$appointment->status === 'started' ? 'warning' : 'danger'}} pe-0 radius-30 border-0">
                        <div>

                            <span class="material-symbols-outlined  font-30">{{$appointment->status === 'started' ? 'timer' : 'check_small' }}</span>{{$appointment->status}}
                        </div>
                    </a>
                </div>


            </div>
            <div class="progress mt-3" style="height: 4.5px;">
                <div class="progress-bar {{$appointment->status === 'started' ? 'bg-warning' : 'bg-danger'}}" role="progressbar" style="width: {{$appointment->status === 'started' ? '75%' : '100%'}};" aria-valuenow="{{$appointment->status === 'started' ? '75' : '100'}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    @endforeach
</div>
