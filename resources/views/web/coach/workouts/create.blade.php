@extends('web.layouts.app')
@section('custom-css')
<style>
    .appBgColor {
        background: #191b1e;
    }

    .workout-header {
        top:60px;
        z-index: 9;
        height: 50px;
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
                <a class="nav-link active" data-bs-toggle="tab" href="#appointments-all" role="tab"
                   aria-selected="true">
                    <div class="d-flex align-items-center">
                        <div class="tab-title">TRACK</div>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#appointments-started" role="tab"
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

        <div class="col-10 m-auto">
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
                            <span class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                <input type="text" name="weight" class="form-control text-center font-24 font-weight-bold" value="0">
                            <span class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                        </div>
                        <hr>
                    </div>
                @endif

                @if(str_contains($exerciseTypeName, 'Reps'))
                    <div>
                        Reps
                        <hr>
                        <div class="input-group mb-3">
                            <span class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                <input name="reps" type="text" class="form-control text-center font-24 font-weight-bold" value="0">
                            <span class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
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
                            <span class="decrement input-group-text text-danger font-24 font-weight-bold material-symbols-outlined">remove</span>
                                <input name="distance" type="text" class="form-control text-center font-24 font-weight-bold" value="0">
                            <span class="increment material-symbols-outlined input-group-text text-success font-24">add</span>
                        </div>
                        <hr>
                    </div>

                @endif


                <div class="d-flex d-grid align-items-center justify-content-center gap-3 mt-5">
                    <button class="btn btn-warning px-4 w-100" id="saveWorkout">Save</button>
                    <button class="btn btn-success px-4 w-100" style="display: none;" id="updateWorkout">Update</button>
                    <button class="btn btn-danger px-4 w-100" style="display: none;" id="cancelUpdate">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3" id="exercisesDoneList">
            @if($workouts->count() > 0)
                @include('web.workout.exercises', $workouts)
            @endif
    </div>


@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const saveButton = document.getElementById('saveWorkout');
            const updateButton = document.getElementById('updateWorkout');
            const cancelButton = document.getElementById('cancelUpdate');


            // Get all elements with class "increment"
            const incrementButtons = document.querySelectorAll('.increment');
            // Add a click event listener to each "increment" element
            incrementButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Find the closest input element
                    const inputElement = this.closest('.input-group').querySelector('input');

                    // Increment the input value by 2.5
                    const currentValue = parseFloat(inputElement.value) || 0;
                    inputElement.value = (currentValue + 2.5);
                });
            });

            const decrementButtons = document.querySelectorAll('.decrement');
            // Add a click event listener to each "decrement" element
            decrementButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    // Find the closest input element
                    const inputElement = this.closest('.input-group').querySelector('input');
                    // Decrement the input value by 2.5
                    const currentValue = parseFloat(inputElement.value) || 0;
                    inputElement.value = Math.max(currentValue - 2.5, 0);

                });
            });


            const form = document.getElementById('storeWorkout');
            const exercisesDoneList = document.getElementById('exercisesDoneList');

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
                    } else {
                        console.log('Form validation failed.');
                    }
                })
                .catch(error => {
                    console.error('Error occurred while sending data to the controller: ' + error);
                });
            });

            // Get all elements with class "workout-update"
            const workoutUpdateDivs = document.querySelectorAll('.workout-update');

            // Add a click event listener to each "workout-update" element
            workoutUpdateDivs.forEach(function (div) {
                div.addEventListener('click', function () {

                    const workoutID = this.parentElement.querySelector('.workout-id').textContent;

                    // Find all elements with the class exercises-type-value-input-name
                    const inputNameElements = this.parentElement.querySelectorAll('.exercises-type-value-input-name');

                    // Iterate through the elements with exercises-type-value-input-name
                    inputNameElements.forEach(function(inputNameElement) {
                        console.log(inputNameElement)
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
                    cancelButton.style.display = 'block';
                });
            });

        });
    </script>
@endsection
{{--ajax call insert data, and retrieve--}}
