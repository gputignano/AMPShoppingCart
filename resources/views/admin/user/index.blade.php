@extends('admin.layouts.main')

@section('meta_title', __('All Users'))

@section('content')
    <h1>{{ __('All Users') }}</h1>

    <p><a href="{{ route('admin.users.create') }}">{{ __('Create New user') }}</a></p>

    @forelse ($users as $user)
        <p><a href="{{ route('admin.users.show', $user) }}">{{ $user->email }}</a></p>
    @empty
        <p>{{ __('No user found!') }}</p>
    @endforelse
@endsection
