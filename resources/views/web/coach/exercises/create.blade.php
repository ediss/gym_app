@extends('web.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="bg-transparent">
                <div class="card-body p-4">
                    <h5 class="mb-4 text-warning text-center">Add New Exercise</h5>
                    <form class="row g-3" method="POST" action="{{route('exercise.store')}}">
                        @csrf
                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <label class="form-label w-100">
                                    <input name="name" type="text" placeholder="Name" class="form-control bg-transparent {{$errors->has('name') ? 'border-danger' : ''}}">
                                </label>
                            </div>

                            <div class="text-danger">
                                @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="input-group mb-3">
                                <label class="form-label w-100">
                                    <select class="form-select" name="exercise_category_id">
                                        @foreach($categories as $category)
                                            <option  value="{{$category->id}}" {!! old('exercise_category_id') == $category->id ? 'selected' : '' !!}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </label>
                            </div>

                            <div class="text-danger">
                                @if($errors->has('exercise_category_id'))
                                    <div class="error">{{ $errors->first('exercise_category_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-group mb-3">
                                <label class="form-label w-100">
                                    <select class="form-select" name="exercise_type_id">
                                        @foreach($types as $type)
                                            <option  value="{{$type->id}}" {!! old('exercise_type_id') == $type->id ? 'selected' : '' !!}>
                                                {{$type->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </label>
                            </div>

                            <div class="text-danger">
                                @if($errors->has('exercise_type_id'))
                                    <div class="error">{{ $errors->first('exercise_type_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <textarea rows="4" name="note" class="form-control bg-transparent" placeholder="Exercise Note"></textarea>

                        </div>

                        <div class="col-12">
                            <div class="col-md-12 mt-3 px-3">
                                <button class="btn btn-warning px-5 w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
