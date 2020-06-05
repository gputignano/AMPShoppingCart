@extends('admin.layouts.main')

@section('meta_title', __('All Products'))

@section('content')
    <h1>{{ __('All Products') }}</h1>

    <p><a href="{{ route('admin.products.create') }}">{{ __('Create Product') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Type') }}</th>
        </thead>

        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="{{ route('admin.products.edit', $product) }}">{{ $product->name }}</a></td>
                <td>{{ class_basename($product->type) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">{{ __('No Product found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
