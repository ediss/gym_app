<div class="mt-5 w-100">

    <div class="card-body">
        <div class="team-list">
            @foreach($appointments as $appointment)



                <div class="d-flex align-items-center gap-3 border-start border-warning border-4 border-0 px-2 py-1">
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold">{{ $appointment->client->name }}</h6>
                        <span class="">
                            {{$appointment->appointment_start->format('H:i')}}
                            -
                            {{$appointment->appointment_end->format('H:i')}}
                        </span>
                    </div>
                    <div class="ms-auto">
                        <a href="{{route('appointment.start', ['id' => $appointment->id])}}" class="btn btn-outline-warning pe-0 radius-30 border-0">
                            <div>
                                @if(isset($pending))
                                    <span class="material-symbols-outlined  font-30">play_circle</span>
                                @endif
                                @if(isset($started))

                                    <div class="spinner-border text-warning spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span>                                </div>

                                @endif
                                {{$appointment->status ?? 'Start'}}
                            </div>
                        </a>
                    </div>
                </div>
                <hr class="border-warning">
            @endforeach

        </div>
    </div>
</div>
