@extends('web.layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert border-0 border-warning border-start border-4 bg-dark-subtle alert-dismissible fade show" id="alert" role="alert">
            <div class="text-warning">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <div class="progress mt-3" style="height:7px;" >
                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"  id="progress" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

        </div>
    @endif
    @foreach($clients as $client)
      <b>{{$client->roles->name}} : </b>  {{ $client->name }} <br/>

    @endforeach
@endsection

@section('scripts')
    @if(Session::has('success'))
        <script src="{{ asset('alerts/alerts.js') }}"></script>
    @endif
@endsection
