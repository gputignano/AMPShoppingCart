@extends('admin.layouts.main')

@section('meta_title', __('All Users'))

@section('content')
    <h1>{{ __('All Users') }}</h1>

    @forelse ($users as $user)
        <p>{{ $user->email }}</p>
    @empty
        <p>{{ __('No user found!') }}</p>
    @endforelse
@endsection
