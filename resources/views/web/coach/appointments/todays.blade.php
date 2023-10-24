@extends('web.layouts.app')

@section('custom-css')
    <style>
        .font-40 {
            font-size: 40px !important;
        }
    </style>

@endsection

@section('content')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 row-cols-xxl-4">

        <div class="d-flex align-items-center mb-4">
            <div class="">
                <!--                <label class="form-label">Date Format</label>-->
                <!--                <input type="hidden" class="form-control date-format flatpickr-input" value="2023-04-21"><input class="form-control date-format input" placeholder="" tabindex="0" type="text" readonly="readonly">-->

                <h1>Appointments</h1>
            </div>


            <div class="text-warning ms-auto">
                <router-link :to="{name: 'appointment.create'}"
                             class=" btn btn-outline-warning px-0 radius-30 border-0">
                    <span class="material-symbols-outlined font-40 w-100">add</span>
                </router-link>
            </div>
        </div>

        <div class="col-12">

            <ul class="nav nav-tabs nav-warning d-flex justify-content-between" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#appointments-all" role="tab"
                       aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                                <i class="fadeIn animated bx bx-list-ul font-20 me-1"></i>
                            </div>
                            <div class="tab-title">All</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#appointments-started" role="tab"
                       aria-selected="false">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon">
                                <i class="fadeIn animated bx bx-play-circle font-20 me-1"></i>
                            </div>
                            <div class="tab-title">
                                Started
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
                <div class="tab-pane fade show active" id="appointments-all" role="tabpanel">
                    <div class="col mt-3">
                        @foreach($appointments as $appointment)
                            <div class="card radius-10 border-0 border-start border-warning border-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <p class="mb-1">{{$appointment->appointment_start}}</p>
                                            <h4 class="mb-0 text-warning">{{$appointment->client_name}}</h4>
                                        </div>


                                        <div class="ms-auto">
                                            <a href="{{route('appointment.start', ['id' => $appointment->id])}}" class="btn btn-outline-warning pe-0 radius-30 border-0">
                                                <div>
                                                    <span class="material-symbols-outlined  font-30">play_circle</span>start
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="appointments-started" role="tabpanel">
                    @include('web.coach.appointments.appointment', ['appointments' => $appointments->where('status','started')])
                </div>
                <div class="tab-pane fade" id="appointments-finished" role="tabpanel">
                    @include('web.coach.appointments.appointment', ['appointments' => $appointments->where('status','finished')])
                </div>
            </div>
        </div>


    </div>
@endsection
