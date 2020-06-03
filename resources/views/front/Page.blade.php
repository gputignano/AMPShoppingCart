@extends('front.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('meta_description', $rewrite->meta_description)

@section('amp-components')
    @parent

@endsection

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div>{!! $entity->description !!}</div>
@endsection