@extends('front.layouts.main')

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div>{{ __('Price: ') . $entity->price }}</div>

    <div>{{ __('Quantity: ') . $entity->quantity }}</div>

    <h2>{{ __('Description') }}</h2>
    <div>{{ $entity->description }}</div>

    <h2>{{ __('More Info') }}</h2>
    <div>
        @foreach ($entity->attributes()->isVisibleOnFront(true)->get() as $attribute)
            <div>{{ $attribute->label }}: {{ $entity->{$attribute->code} }}</div>
        @endforeach
    </div>
@endsection
