@extends('admin.layouts.main')

@section('meta_title', __('All Orders'))

@section('content')
    <h1>{{ __('All Orders') }}</h1>

    <p><a href="{{ route('admin.orders.create') }}">{{ __('Create Order') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('User ID') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Created At') }}</th>
            <th>{{ __('Updated At') }}</th>
            <th>{{ __('Action') }}</th>
        </thead>

        @forelse ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
                <td><a href="{{ route('admin.orders.edit', $order) }}">{{ __('View') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="6">{{ __('No Order found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
