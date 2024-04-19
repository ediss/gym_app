@extends('web.layouts.app')

@section('content')
    <div class="row">
        @if(Session::has('success'))
            <div class="alert border-0 border-warning border-start border-4 bg-dark-subtle alert-dismissible fade show" id="alert" role="alert">
                <div class="text-warning">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                <div class="progress mt-3" style="height:7px;" >
                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"  id="progress" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

            </div>
        @endif
        <div class="col-12 mb-4">
            <label class="w-100">
                <input name="search_exercises" id="searchExercises" type="text" class="form-control" value ='' placeholder="Search..."
                       oninput="searchExercises()" data-usage-type="exercises_crud">
            </label>
        </div>

        <div class="col-12" id="exerciseCategories">
            <div class="card" >
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($categories as $category)
                            <li class="d-flex justify-content-between align-items-center list-group-item category"
                                data-category-id="{{$category->id}}" data-usage-type="exercises_crud">
                                {{ $category->name }}
                                <span class="badge border border-warning rounded-pill font-15 ">
                                    {{ count($category->exercises) }}
                                </span>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div id="exerciseResults" class="col-12"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('exercises/exercises.js') }}"></script>
    @if(Session::has('success'))
        <script src="{{ asset('alerts/alerts.js') }}"></script>
    @endif
@endsection
