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

                                <input type="text" name="start_date" placeholder="Select Date.." class="form-control flatpickr">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.start_date">
{{--                                    {{ message }}--}}
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <label for="start_time" class="text-warning">Start</label>
                            <input type="text" name="start_time" class="form-control" id="start_time" required>
                        </div>

                        <div class="col-12">
                            <label for="end_time" class="text-warning">Finish</label>
                            <input type="text" name="end_time" class="form-control" id="end_time" required>
                        </div>



                        <div class="col-12">

                            <label for="appointment-client" class="text-warning">Choose Client</label>
                            <select name="client_id" id="appointment-client" class="form-select">

                                @foreach($clients as $client)
                                    <option  value="{{$client->id}}">
                                        {{ $client->name }}
                                    </option>
                                @endforeach

                            </select>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.client_id">
{{--                                    {{ message }}--}}
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 mt-5 px-3">
                            <button class="btn btn-warning px-5 w-100">Save</button>
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


        const appointmentStart = $("#start_time");
        const appointmentEnd = $("#end_time");

        appointmentStart.flatpickr({
            mode:"multiple",
            enableTime: true,
            time_24hr: true,
            disableMobile:true,
            noCalendar: true,
            dateFormat: "H:i",
            defaultDate: new Date(0, 0, 0, 7, 0),

            onClose: function(selectedDates, dateStr, instance) {

                const inputValue = instance.input.value;

                const originalTime = new Date(`1970-01-01T${inputValue}:00`);

                originalTime.setHours(originalTime.getHours() + 1);

                const updatedTimeString = originalTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });

                appointmentEnd.flatpickr({
                    enableTime: true,
                    time_24hr: true,
                    disableMobile:true,
                    noCalendar: true,
                    defaultDate : updatedTimeString,

                });


            },
        });

        appointmentEnd.flatpickr({
            enableTime: true,
            time_24hr: true,
            disableMobile:true,
            noCalendar: true,
            defaultDate: new Date(0, 0, 0, 8, 0),
        });


    </script>
@endsection
