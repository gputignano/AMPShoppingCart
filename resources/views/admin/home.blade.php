@extends('admin.layouts.main')

@section('meta_title', __('Admin Home'))

@section('content')
    <h1>{{ __('Admin Home') }}</h1>

    <div>
        <a href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a>
    </div>

    <div>
        <a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
    </div>

    <div>
        <a href="{{ route('admin.products.index') }}">{{ __('Products') }}</a>
    </div>
@endsection

