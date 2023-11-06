    <div class="ca2rd bg-transparent">

        <div class="card-body">
            <div class="accordion accordion-flush">

                @php
                    $counter = 1;
                @endphp
                @foreach($exerciseHistory as $key => $workout)
                    @php
                        $counter++;
                        $appointmentID = $workout[0]->appointment_id;
                    @endphp

                    <div class="accordion-item bg-transparent border-bottom-0">
                        <h1 class="accordion-header text-light">

                            <button class="accordion-button accordion-button-custom collapsed bg-transparent px-0" type="button"
                                    data-bs-toggle="modal" data-bs-target="#exampleDarkModal" data-appointment-id="{{ $appointmentID }}">
                                {{ $key }}
                            </button>
                        </h1>

                        <div class="accordion-collapse collapse show">
                            <div class="accordion-body px-0">
                                @include('web.workout.exercises', ['workouts' => $workout])
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleDarkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">

                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title text-white">Workout History</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white" id="workout-history-content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
