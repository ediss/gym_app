@extends('web.layouts.app')


@section('content')
    <div class="row">

        <div class="col-lg-12">
            <div class="bg-transparent">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Add New Client</h5>
                    <form class="row g-3" action="{{ route('client.store') }}" method="POST">

                        @csrf
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input v-model="client.name" name="name" type="text" placeholder="Name" class="form-control bg-transparent">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.name">
{{--                                    {{ message }}--}}
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input v-model="client.email" name="email" type="email" placeholder="E-mail address" class="form-control bg-transparent">
                            </div>

                            <div class="text-danger">
                                <div v-for="message in validationErrors?.email">
{{--                                    {{ message }}--}}
                                </div>
                            </div>

                        </div>


                        <div class="col-12">
                            <div class="col-md-12 ">
                                <button class="btn btn-warning  w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
