@extends('web.layouts.app')
@section('custom-css')
    <style>
        .appBgColor {
            background: #191b1e;
        }

        .workout-header {
            top: 60px;
            z-index: 9;
            height: 50px;
        }

        .accordion-button:not(.collapsed) {
            background-color: transparent;
            box-shadow: none;

        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button-custom:after {
            content: none;
        }

        hr {
            margin:0.6rem 0;
        }
    </style>
@endsection

@section('header')
    @php
        $changeHeader = true;
    @endphp
    <h5 class="text-warning m-0">{{ $exercise->name }}</h5>

    <b>{{ $appointment->client->name }}</b>
@endsection

@section('additionalHeader')
    <div class="bg-dark position-sticky workout-header">
        <ul class="nav nav-tabs nav-warning d-flex justify-content-between h-100 align-items-center" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#workout-create" role="tab" aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">TRACK</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#exercise-history" role="tab" aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">
                            HISTORY
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#appointments-finished" role="tab" aria-selected="false"
                    disabled>
                    <div class="d-flex align-items-center">
                        <div class="tab-title">GRAPH</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">


            <div class="tab-content">
                <div class="tab-pane fade  show active" id="workout-create" role="tabpanel">
                    <form action="{{ route('workout.store') }}" method="POST" id="storeWorkout">
                        @csrf


                        <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                        <input type="hidden" name="client_id" value="{{ $appointment->client->id }}">
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        <input type="hidden" name="coach_id" value="{{ Auth::user()->id }}">

                        @if (str_contains($exerciseTypeName, 'Weight'))
                            <div>
                                Weight
                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input type="number" name="weight"
                                        class="form-control text-center font-24 font-weight-bold" value="{{ $lastRecord->weight ?? '0' }}"
                                        step="0.01">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>
                        @endif

                        @if (str_contains($exerciseTypeName, 'Reps'))
                            <div>
                                Reps
                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input name="reps" type="text"
                                        class="form-control text-center font-24 font-weight-bold" value="{{ $lastRecord->reps ?? '0' }}">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>
                        @endif

                        @if (str_contains($exerciseTypeName, 'Time'))
                            <div>
                                Time
                            </div>
                        @endif

                        @if (str_contains($exerciseTypeName, 'Distance'))
                            <div>
                                Distance (in meters)

                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input name="distance" type="text"
                                        class="form-control text-center font-24 font-weight-bold" value="{{ $lastRecord->distance ?? '0' }}">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>
                        @endif


                        <div class="">
                            <button class="btn btn-warning px-4 w-100" id="saveWorkout" value="save"
                                onclick="setClickedButton('save')">Save
                            </button>


                            <div class="update-delete-buttons d-flex d-grid align-items-center justify-content-center gap-3 d-none">
                                <button class="btn btn-success px-4 w-100" id="updateWorkout"
                                    value="update" onclick="setClickedButton('update')">Update
                                </button>
                                <button class="btn btn-danger px-4 w-100" data-bs-toggle="modal"
                                    data-bs-target="#deleteWorkoutSetModal" type="button">Delete
                                </button>
                            </div>




                            <input type="hidden" name="clickedButton" id="clickedButton" value="">


                            <input type="hidden" name="workout_id" id="workoutIDHidden" value="">

                        </div>
                    </form>

                    <div class="row mt-3" id="exercisesDoneList">
                        @if ($workouts->count() > 0)
                            @include('web.workout.exercises', $workouts)
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="exercise-history" role="tabpanel">

                    @if ($exerciseHistory->count() > 0)
                        @include('web.coach.exercises.history')
                    @else
                        No records
                    @endif
                </div>
            </div>


        </div>
    </div>

    <div class="modal fade" id="deleteWorkoutSetModal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning">Delete Set</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-warning">Are you sure you want to delete the selected set?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="deleteWorkout" value="delete"
                        onclick="setClickedButton('delete')">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const saveButton = document.getElementById('saveWorkout');
        const updateButton = document.getElementById('updateWorkout');
        const deleteButton = document.getElementById('deleteWorkout');
        const form = document.getElementById('storeWorkout');

        const exercisesDoneList = document.getElementById('exercisesDoneList');


        updateButton.addEventListener("click", function() {
            let url = "{{ route('workout.update', ':workoutID') }}";
            setFormUrl(url);
        });


        deleteButton.addEventListener("click", function() {
            let url = "{{ route('workout.delete', ':workoutID') }}";
            setFormUrl(url);
            form.submit();

        });

        function setFormUrl(url) {
            const workoutID = document.getElementById("workoutIDHidden").value;
            let form_action = url.replace(':workoutID', workoutID);
            form.action = form_action;
        }

        // Function to set the clicked button value in the hidden input field
        function setClickedButton(buttonValue) {
            document.getElementById('clickedButton').value = buttonValue;
        }

        function attachClickEventToWorkoutUpdateElements() {

            // Get all elements with class "workout-update"
            const workoutUpdateDivs = document.querySelectorAll('.workout-update');

            // Add a click event listener to each "workout-update" element
            workoutUpdateDivs.forEach(function(div) {

                div.addEventListener('click', function() {
                    document.querySelector(".top-header").scrollIntoView();

                    const workoutID = this.parentElement.querySelector('.workout-id').textContent;

                    document.getElementById("workoutIDHidden").value = workoutID;

                    // Find all elements with the class exercises-type-value-input-name
                    const inputNameElements = this.parentElement.querySelectorAll(
                        '.exercises-type-value-input-name');

                    // Iterate through the elements with exercises-type-value-input-name
                    inputNameElements.forEach(function(inputNameElement) {
                        // Get the value of the corresponding exercises-type-value element
                        const exercisesTypeInputValue = inputNameElement.closest('.workout-update')
                            .querySelector('.exercises-type-value').textContent.trim();

                        // Get the name from the input-name element
                        const exercisesTypeInputName = inputNameElement.textContent.trim();

                        // Find the input element with the specified name
                        const inputElement = document.querySelector(
                            `input[name="${exercisesTypeInputName}"]`);

                        if (inputElement) {
                            // Set the value of the input element
                            inputElement.value = exercisesTypeInputValue;
                        }
                    });

                    saveButton.style.display = 'none';

                    document.querySelector(".update-delete-buttons").classList.remove('d-none');
                    
                });
            });
        }

        function attachIncrementClickEventToElements(elements, incrementValues) {
            elements.forEach(function(element) {
                element.addEventListener('click', function() {
                    // Find the closest input element
                    const inputElement = this.closest('.input-group').querySelector('input');
                    const inputName = inputElement.name;

                    // Check if there is a specified increment value for the input name
                    if (incrementValues.hasOwnProperty(inputName)) {
                        // Increment the input value by the specified increment value
                        const currentValue = parseFloat(inputElement.value) || 0;
                        inputElement.value = (currentValue + incrementValues[inputName]);
                    }
                });
            });
        }

        function attachDecrementClickEventToElements(elements, incrementValues) {
            elements.forEach(function(element) {
                element.addEventListener('click', function() {
                    // Find the closest input element
                    const inputElement = this.closest('.input-group').querySelector('input');
                    const inputName = inputElement.name;

                    // Check if there is a specified decrement value for the input name
                    if (incrementValues.hasOwnProperty(inputName)) {
                        // Decrement the input value by the specified decrement value
                        const currentValue = parseFloat(inputElement.value) || 0;
                        inputElement.value = Math.max(currentValue - incrementValues[inputName], 0);
                    }
                });
            });
        }


        const incrementButtons = document.querySelectorAll('.increment');
        const decrementButtons = document.querySelectorAll('.decrement');


        // Define an object that maps input names to their corresponding increment values
        const incrementValues = {
            weight: 2.5,
            reps: 1,
            time: 1,
            distance: 100
        };

        function submitFormAndHandleResponse(form, exercisesDoneList) {
            form.addEventListener('submit', function(event) {

                event.preventDefault();

                // Serialize form data to send to the controller
                const formData = new FormData(form);

                fetch(form.getAttribute('action'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => response.text())
                    .then(responseText => {
                        // Check if the response is valid, you can add more validation logic here
                        if (responseText) {
                            // Add the response to the exercisesDoneList div
                            exercisesDoneList.innerHTML = responseText;

                            // Attach click event to workout update elements
                            attachClickEventToWorkoutUpdateElements();
                        } else {
                            console.log('Form validation failed.');
                        }
                    })
                    .catch(error => {
                        console.error('Error occurred while sending data to the controller: ' + error);
                    });

                // Get the clicked button value from the hidden input field
                const clickedButton = document.getElementById('clickedButton').value;

                if (clickedButton === 'update' || clickedButton === 'delete') {

                    form.action = '{{ route('workout.store') }}';

                    saveButton.style.display = 'block';
                    document.querySelector(".update-delete-buttons").classList.add('d-none');
                }
            });
        }

        //used on 2 places
        function fetchWorkouts(appointmentId) {
            fetch('{{ route('appointment.workouts') }}', {
                    method: 'POST',
                    body: JSON.stringify({
                        appointmentId: appointmentId
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.text())
                .then(html => {
                    // Update the DOM with the fetched Blade view
                    document.getElementById('workout-history-content').innerHTML = html;
                })
                .catch(error => console.error('Error fetching workout exercises: ' + error));
        }



        document.addEventListener("DOMContentLoaded", function() {

            const buttons = document.querySelectorAll("[data-appointment-id]");

            // Add a click event listener to each button
            buttons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Get the value of the data-appointment-id attribute
                    const appointmentId = this.getAttribute("data-appointment-id");

                    fetchWorkouts(appointmentId)
                });
            });


            attachClickEventToWorkoutUpdateElements();
            attachIncrementClickEventToElements(incrementButtons, incrementValues);

            attachDecrementClickEventToElements(decrementButtons, incrementValues);

            submitFormAndHandleResponse(form, exercisesDoneList);

        });
    </script>
@endsection
