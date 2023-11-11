@extends('web.layouts.app')

@section('custom-css')
    <style>
        .font-40 {
            font-size: 40px !important;
        }
    </style>

@endsection

@section('content')

    @php
        $startedAppointments = $appointments->where('status' , 'In progress')->count();
    @endphp
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">

        @if(Session::has('success'))
            <div class="alert border-0 border-warning border-start border-4 bg-dark-subtle alert-dismissible fade show" id="alert" role="alert">
                <div class="text-warning">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <div class="progress mt-3" style="height:7px;" >
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"  id="progress" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

            </div>
        @endif

        <div class="d-flex align-items-center mb-4">
            <div class="">
                <!--                <label class="form-label">Date Format</label>-->
                <!--                <input type="hidden" class="form-control date-format flatpickr-input" value="2023-04-21"><input class="form-control date-format input" placeholder="" tabindex="0" type="text" readonly="readonly">-->

                <h1>Appointments</h1>
            </div>


            <div class="text-warning ms-auto">
                <a href="{{route('appointment.create')}}" class=" btn btn-outline-warning px-0 radius-30 border-0">
                    <span class="material-symbols-outlined font-40 w-100">add</span>
                </a>
            </div>
        </div>

        <div class="col-12">

            <ul class="nav nav-tabs nav-warning d-flex justify-content-between  border-success" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $startedAppointments === 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#appointments-pending" role="tab"
                       aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                                <i class="fadeIn animated bx bx-list-ul font-20 me-1"></i>
                            </div>
                            <div class="tab-title">Pending</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $startedAppointments > 0 ? 'active' : '' }}" data-bs-toggle="tab" href="#appointments-started" role="tab"
                       aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                                <i class="fadeIn animated bx bx-play-circle font-20 me-1"></i>
                            </div>
                            <div class="tab-title">
                                In progress
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#appointments-finished" role="tab"
                       aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                                <i class="fadeIn animated bx bx-check-circle font-20 me-1"></i>

                            </div>
                            <div class="tab-title">Finished</div>
                        </div>
                    </a>
                </li>
            </ul>

            <div class="tab-content py-3">

                <div class="tab-pane fade  {{ $startedAppointments === 0 ? 'show active' : '' }}" id="appointments-pending" role="tabpanel">


                    @include('web.coach.appointments.appointment', ['appointments' => $appointments->whereNull('status'), 'pending' => true])


                </div>
                <div class="tab-pane fade {{ $startedAppointments > 0 ? 'show active' : '' }}" id="appointments-started" role="tabpanel">

                    @include('web.coach.appointments.appointment', ['appointments' => $appointments->where('status','In progress'), 'started' => true])
                </div>
                <div class="tab-pane fade" id="appointments-finished" role="tabpanel">
                    @include('web.coach.appointments.appointment', ['appointments' => $appointments->where('status','finished')])
                </div>
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    @if(Session::has('success'))
        <script src="{{ asset('alerts/alerts.js') }}"></script>
    @endif

@endsection
