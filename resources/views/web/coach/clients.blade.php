@extends('web.layouts.app')

@section('content')
    @foreach($clients as $client)
      <b>{{$client->roles->name}} : </b>  {{ $client->name }} <br/>

    @endforeach
@endsection
