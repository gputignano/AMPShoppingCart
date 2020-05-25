@extends('front.layouts.main')

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div>{{ __('Price: ') . $entity->price }}</div>

    <div>{{ __('Quantity: ') . $entity->quantity }}</div>

    <div>{{ $entity->description }}</div>
@endsection
