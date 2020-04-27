@extends('admin.layouts.main')

@section('meta_title', __('All Users'))

@section('content')
    <h1>{{ __('All Users') }}</h1>

    <p><a href="{{ route('admin.users.create') }}">{{ __('Create New user') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Email') }}</th>
        </thead>

        @forelse ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ route('admin.users.edit', $user) }}">{{ $user->email }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No user found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
