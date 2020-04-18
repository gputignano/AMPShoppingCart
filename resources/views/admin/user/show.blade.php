@extends('admin.layouts.main')

@section('meta_title', __('Show User'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show User') }}</h1>

    <p><a href="{{ route('admin.users.edit', $user) }}">{{ __('Edit') }}</a></p>

    <p>{{ $user->email }}</p>

    <form action-xhr="{{ route('admin.users.destroy', $user) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
