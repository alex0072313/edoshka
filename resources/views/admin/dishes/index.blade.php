@extends('layouts.admin')

@section('content')
    @foreach($dishes as $dish)
        {{ dump($dish) }}
    @endforeach
@endsection