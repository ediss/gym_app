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
    </style>
@endsection

@section('header')
    @php
        $changeHeader = true;
    @endphp
    <h2 class="text-warning m-0">{{ $exercise->name }}</h2>

    <b>{{ $appointment->client->name }}</b>
@endsection

@section('additionalHeader')
    <div class="bg-dark position-sticky workout-header">
        <ul class="nav nav-tabs nav-warning d-flex justify-content-between h-100 align-items-center" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#workout-create" role="tab"
                   aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">TRACK</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#exercise-history" role="tab"
                   aria-selected="false">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">
                            HISTORY
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#appointments-finished" role="tab"
                   aria-selected="false" disabled>
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


            <div class="tab-content py-3">
                <div class="tab-pane fade  show active" id="workout-create" role="tabpanel">
                    <form action="{{route('workout.store')}}" method="POST" id="storeWorkout">
                        @csrf


                        <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                        <input type="hidden" name="client_id" value="{{ $appointment->client->id }}">
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        <input type="hidden" name="coach_id" value="9">
                        @if (str_contains($exerciseTypeName, 'Weight'))
                            <div>
                                Weight
                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input type="text" name="weight"
                                           class="form-control text-center font-24 font-weight-bold" value="0">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>
                        @endif

                        @if(str_contains($exerciseTypeName, 'Reps'))
                            <div>
                                Reps
                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input name="reps" type="text"
                                           class="form-control text-center font-24 font-weight-bold" value="0">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>
                        @endif

                        @if(str_contains($exerciseTypeName, 'Time'))
                            <div>
                                Time
                            </div>
                        @endif

                        @if(str_contains($exerciseTypeName, 'Distance'))
                            <div>
                                Distance

                                <hr>
                                <div class="input-group mb-3">
                                    <span
                                        class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                    <input name="distance" type="text"
                                           class="form-control text-center font-24 font-weight-bold" value="0">
                                    <span
                                        class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                                </div>
                                <hr>
                            </div>

                        @endif


                        <div class="d-flex d-grid align-items-center justify-content-center gap-3 mt-5">
                            <button class="btn btn-warning px-4 w-100" id="saveWorkout" value="save"
                                    onclick="setClickedButton('save')">Save
                            </button>
                            <button class="btn btn-success px-4 w-100" style="display: none;" id="updateWorkout"
                                    value="update" onclick="setClickedButton('update')">Update
                            </button>
                            <button class="btn btn-danger px-4 w-100" style="display: none;" id="deleteWorkout"
                                    value="delete" onclick="setClickedButton('delete')">Delete
                            </button>

                            <input type="hidden" name="clickedButton" id="clickedButton" value="">

                        </div>
                    </form>

                    <div class="row mt-3" id="exercisesDoneList">
                        @if($workouts->count() > 0)
                            @include('web.workout.exercises', $workouts)
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="exercise-history" role="tabpanel">

                    @if($exerciseHistory->count() > 0)
                        @include('web.coach.exercises.history')
                    @else
                        No records
                    @endif
                </div>
            </div>


        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('exercises/exercises.js')}}"></script>


    <script>


        const saveButton = document.getElementById('saveWorkout');
        const updateButton = document.getElementById('updateWorkout');
        const deleteButton = document.getElementById('deleteWorkout');

        // Function to set the clicked button value in the hidden input field
        function setClickedButton(buttonValue) {
            document.getElementById('clickedButton').value = buttonValue;
        }

        function attachClickEventToWorkoutUpdateElements() {

            // Get all elements with class "workout-update"
            const workoutUpdateDivs = document.querySelectorAll('.workout-update');

            // Add a click event listener to each "workout-update" element
            workoutUpdateDivs.forEach(function (div) {
                div.addEventListener('click', function () {

                    const workoutID = this.parentElement.querySelector('.workout-id').textContent;

                    // Find all elements with the class exercises-type-value-input-name
                    const inputNameElements = this.parentElement.querySelectorAll('.exercises-type-value-input-name');

                    // Iterate through the elements with exercises-type-value-input-name
                    inputNameElements.forEach(function (inputNameElement) {
                        // Get the value of the corresponding exercises-type-value element
                        const exercisesTypeInputValue = inputNameElement.closest('.workout-update').querySelector('.exercises-type-value').textContent.trim();

                        // Get the name from the input-name element
                        const exercisesTypeInputName = inputNameElement.textContent.trim();

                        // Find the input element with the specified name
                        const inputElement = document.querySelector(`input[name="${exercisesTypeInputName}"]`);

                        if (inputElement) {
                            // Set the value of the input element
                            inputElement.value = exercisesTypeInputValue;
                        }
                    });

                    let url = '{{ route("workout.update", ":id") }}';
                    url = url.replace(':id', workoutID);

                    form.action = url;

                    saveButton.style.display = 'none';
                    updateButton.style.display = 'block';
                    deleteButton.style.display = 'block';
                });
            });
        }

        function attachIncrementClickEventToElements(elements, incrementValues) {
            elements.forEach(function (element) {
                element.addEventListener('click', function () {
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
            elements.forEach(function (element) {
                element.addEventListener('click', function () {
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

        const form = document.getElementById('storeWorkout');

        const incrementButtons = document.querySelectorAll('.increment');
        const decrementButtons = document.querySelectorAll('.decrement');


        // Define an object that maps input names to their corresponding increment values
        const incrementValues = {
            weight: 2.5,
            reps: 1,
            time: 1
        };


        const exercisesDoneList = document.getElementById('exercisesDoneList');


        function submitFormAndHandleResponse(form, exercisesDoneList) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                // Serialize form data to send to the controller
                const formData = new FormData(form);

                fetch(form.getAttribute('action'), {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

                if (clickedButton === 'update') {

                    form.action = '{{ route("workout.store") }}';

                    saveButton.style.display = 'block';
                    updateButton.style.display = 'none';
                    deleteButton.style.display = 'none';
                }
            });
        }



        //used on 2 places
        function fetchWorkouts(appointmentId) {
            fetch('{{route('appointment.workouts')}}', {
                method: 'POST',
                body: JSON.stringify({ appointmentId: appointmentId }),
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



        document.addEventListener("DOMContentLoaded", function () {

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
