@if($workouts->count() > 0)
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">Workouts</h5>
            <div class="my-3 border-top"></div>
            <div class="accordion accordion-flush" id="accordionFlushExample">

                @php
                    $counter = 1;
                @endphp
                @foreach($workouts as $key => $workout)
                    @php
                        $counter++;
                    @endphp

                    <div class="accordion-item">
                        <h1 class="accordion-header text-light" id="flush-heading{{ $counter }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse{{ $counter }}" aria-expanded="false"
                                    aria-controls="flush-collapse{{ $counter }}">
                                {{$key}}
                            </button>
                        </h1>

                        <div id="flush-collapse{{ $counter }}" class="accordion-collapse collapse"
                             aria-labelledby="flush-heading{{ $counter }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body px-0">
                                @include('web.workout.exercises', ['workouts' => $workout])
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    </div>
@endif
