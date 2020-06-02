@extends('front.layouts.cart')

@section('amp-components')
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Shopping Cart') }}</h1>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Quantity') }}</th>
            <th>{{ __('Action') }}</th>
        </thead>
        @foreach (\Cart::getContent() as $cartItem)
            <tr>
                <td>{{ $cartItem->id }}</td>
                <td><a href="{{ $cartItem->model->rewrite->slug }}">{{ $cartItem->name }}</a></td>
                <td>{{ $cartItem->price }}</td>
                <td>{{ $cartItem->quantity }}</td>
                <td>
                    <form action-xhr="{{ route('cart.destroy', $cartItem->id) }}" method="post">
                        @csrf
                        @method('delete')

                        <input type="submit" value="{{ __('Remove') }}">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection