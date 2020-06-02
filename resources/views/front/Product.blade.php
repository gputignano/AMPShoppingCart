@extends('front.layouts.main')

@section('amp-components')
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div>{{ __('Price: ') . $entity->price }}</div>

    <div>{{ __('Quantity: ') . $entity->quantity }}</div>

    <form action-xhr="{{ route('cart.store') }}" method="post">
        @csrf

        <input type="hidden" name="id" value="{{ $entity->id }}">
        <input type="hidden" name="name" value="{{ $entity->name }}">
        <input type="hidden" name="price" value="{{ $entity->price }}">
        <input type="submit" value="{{ __('Add to Cart') }}">

        <div submitting>
            SUBMITTING
        </div>
    </form>

    <h2>{{ __('Description') }}</h2>
    <div>{{ $entity->description }}</div>

    <h2>{{ __('More Info') }}</h2>
    <div>
        @foreach ($entity->attributes()->isVisibleOnFront(true)->get() as $attribute)
            <div>{{ $attribute->label }}: {{ $entity->{$attribute->code} }}</div>
        @endforeach
    </div>
@endsection
