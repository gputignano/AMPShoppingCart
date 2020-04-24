@extends('admin.layouts.main')

@section('meta_title', __('Show Order'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show Order') }}</h1>

    <dl>
        <dt>{{ __('ID') }}</dt>
        <dd>{{ $order->id }}</dd>

        <dt>{{ __('User') }}</dt>
        <dd>{{ $order->user->email }}</dd>

        <dt>{{ __('Created At') }}</dt>
        <dd>{{ $order->created_at }}</dd>

        <dt>{{ __('Updated At') }}</dt>
        <dd>{{ $order->updated_at }}</dd>
    </dl>

    <table>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Code') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Price') }}</th>
            <th>{{ __('Quantity') }}</th>
        </tr>
        @foreach ($order->orderDetails as $detail)
            <tr>
                <td>{{ $detail->id }}</td>
                <td>{{ $detail->code }}</td>
                <td>{{ $detail->name }}</td>
                <td>{{ $detail->price }}</td>
                <td>{{ $detail->quantity }}</td>
            </tr>
        @endforeach
    </table>

    <form action-xhr="{{ route('admin.orders.destroy', $order) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
