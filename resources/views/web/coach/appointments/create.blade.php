@extends('web.layouts.app')
@section('custom-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Make Appointment</h5>
                    <form action="{{route('appointment.store')}}" method="POST" class="row g-3">

                        @csrf
                        <div class="col-md-12">
                            <div class="input-group mb-3">

                                <span class="input-group-text text-warning bg-transparent" >
                                    <i class="lni lni-calendar"></i>
                                </span>

                                <input type="text" name="start_date" placeholder="Select Date.." class="form-control flatpickr" id="start_date">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.start_date">
{{--                                    {{ message }}--}}
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <label for="start_time" class="text-warning">Start</label>
                            <input type="text" name="appointment_start" class="form-control" id="start_time" value="{{ old('appointment_start', 7) }}" required>
                            @error('appointment_start')
                            <span class="text-danger" id="appointment_start_error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="end_time" class="text-warning">Finish</label>
                            <input type="text" name="appointment_end" class="form-control" id="end_time" value="{{ old('appointment_end', 8) }}" required>

                            <span class="text-danger" id="appointment_end_error">
                                @error('appointment_end')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="col-12">

                           @include('web.partial.appointments.create.client-list', ['clients' => $clients])

                        </div>



                        <div class="col-md-12 mt-5 px-3">
                            <button class="btn btn-warning px-5 w-100" id="createAppointment">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        $(".flatpickr").flatpickr({
            disableMobile: true,
            position: "auto center",
            defaultDate: new Date(),
            dateFormat: "Y-m-d",
            altFormat: "j. F Y",
            altInput: true,        // Enable an alternative input field for the server format
            // altFormat : "Y M d",
        });


        // Get references to the appointment start and end input elements
        const appointmentStart = document.getElementById("start_time");
        const appointmentEnd = document.getElementById("end_time");

        // Initialize the flatpickr instance for appointment start
        let flatpickrStart = flatpickr(appointmentStart, {
            mode: "multiple",
            enableTime: true,
            time_24hr: true,
            disableMobile: true,
            noCalendar: true,
            dateFormat: "H:i",
            // defaultDate: new Date(0, 0, 0, 7, 0),
            onChange: function (selectedDates, dateStr, instance) {
                const inputValue = instance.input.value;
                const originalTime = new Date(`1970-01-01T${inputValue}:00`);
                originalTime.setHours(originalTime.getHours() + 1);
                const updatedTimeString = originalTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

                // Initialize the flatpickr instance for appointment end
                flatpickrEnd.setDate(updatedTimeString);


            },
        });

        // Initialize the flatpickr instance for appointment end
        let flatpickrEnd = flatpickr(appointmentEnd, {
            enableTime: true,
            time_24hr: true,
            disableMobile: true,
            noCalendar: true,
            // defaultDate: new Date(0, 0, 0, 8, 0),
        });





        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('start_date');
            const appointmentClientsDropdown = document.getElementById('appointment-clients');



            appointmentEnd.addEventListener('change', validateTime);
            appointmentStart.addEventListener('change', validateTime);


            function validateTime() {
                let timeErrorMessage = document.getElementById('appointment_end_error');
                let appointmentStartError = document.getElementById('appointment_start_error');
                appointmentStartError ? appointmentStartError.textContent='' : null;


                let createAppointmentButton = document.getElementById('createAppointment');

                // Parse the values of start_time and end_time as time objects
                let startTime = new Date("2000-01-01 " + appointmentStart.value);
                let endTime = new Date("2000-01-01 " + appointmentEnd.value);

                // Check if end_time is lower than start_time
                if (endTime < startTime) {
                    timeErrorMessage.textContent = 'End time cannot be lower than start time';
                    createAppointmentButton.disabled = true;
                    createAppointmentButton.textContent = 'disabled';
                    createAppointmentButton.classList.remove('btn-warning');
                    createAppointmentButton.classList.add('btn-danger');


                }else {
                    timeErrorMessage.textContent = '';
                    createAppointmentButton.disabled = false;
                    createAppointmentButton.textContent = 'Save';
                    createAppointmentButton.classList.remove('btn-danger');
                    createAppointmentButton.classList.add('btn-warning');

                }
            }

            startDateInput.addEventListener('change', function() {
                const startDateValue = startDateInput.value;

                // Make an AJAX request to the Laravel route
                fetch('{{ route('appointment.available-clients') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        start_date: startDateValue
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        // Clear the existing options in the dropdown list
                        appointmentClientsDropdown.innerHTML = '';
                        const arr = Object.values(data);

                        // Add new options based on the received data
                        arr.forEach(client => {


                            const option = document.createElement('option');
                            option.value = client.id;
                            option.textContent = client.name;
                            appointmentClientsDropdown.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

        });


    </script>
@endsection
