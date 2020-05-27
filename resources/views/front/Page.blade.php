@extends('front.layouts.main')

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div>{!! $entity->description !!}</div>
@endsection