@extends('admin.layouts.main')

@section('meta_title', __('Show Entity Type'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show Attribute') }}</h1>

    <p><a href="{{ route('admin.attributes.edit', $attribute) }}">{{ __('Edit') }}</a></p>

    <p>{{ $attribute->label }}</p>

    <p>{{ $attribute->type }}</p>

    <form action-xhr="{{ route('admin.attributes.destroy', $attribute) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>

    <amp-accordion id="attributes" expand-single-section animate>
        <section>
            <h2>{{ __('Attribute Values') }}</h2>

            <div>
                <ul>
                    @forelse ($attribute->values as $value)
                        <li>{{ $value->value }}</li>
                    @empty
                        <li>{{ __('No value found!') }}</li>
                    @endforelse
                </ul>
            </div>
        </section>
    </amp-accordion>
@endsection
