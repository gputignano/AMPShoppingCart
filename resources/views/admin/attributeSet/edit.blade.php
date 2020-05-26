@extends('admin.layouts.main')

@section('meta_title', __('Edit Attribute Set'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit Attribute Set') }}</h1>

    <form method="post" action-xhr="{{ route('admin.attributeSets.update', $attributeSet) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="label">{{ __('Label') }}</label>
            <input type="text" name="label" value="{{ $attributeSet->label }}">
        </fieldset>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Attribute Set updated successfully!') }}
            </template>
        </div>

        <div submit-error>
            <template type="amp-mustache">
                <ul>
                    @{{#errors}}
                    <li><strong>@{{name}}</strong>: @{{message}}</li>
                    @{{/errors}}
                </ul>
            </template>
        </div>
    </form>

    <amp-accordion id="attributeSets" expand-single-section animate>
        <section>
            <h2>{{ __('Attributes') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.attributeSets.update', $attributeSet) }}">
                    @csrf
                    @method('patch')

                        <ul>
                            @foreach (($attributeSet->parent ? $attributeSet->parent->attributes : App\Models\Attribute::where('is_system', false)->get()) as $attribute)
                                @if ($attribute->products->count())
                                    <input type="hidden" name="attributes[]" value="{{ $attribute->id }}">
                                @endif
                                <li>
                                    <input
                                        type="checkbox"
                                        name="attributes[]"
                                        value="{{ $attribute->id }}"
                                        {{ $attributeSet->attributes()->find($attribute->id) ? 'checked' : '' }}
                                        {{ $attribute->products->count() || $attribute->attribute_sets()->where('id', '>', $attributeSet->id)->count() ? 'disabled' : '' }}
                                    >
                                    {{ $attribute->label }}
                                </li>
                            @endforeach
                        </ul>

                        <input type="submit" value="{{ __('Update') }}">

                    <div submitting>
                        <template type="amp-mustache">
                            {{ __('Submitting...') }}
                        </template>
                    </div>

                    <div submit-success>
                        <template type="amp-mustache">
                            {{ __('Attribute Sets updated successfully!') }}
                        </template>
                    </div>

                    <div submit-error>
                        <template type="amp-mustache">
                            <ul>
                                @{{#errors}}
                                <li><strong>@{{name}}</strong>: @{{message}}</li>
                                @{{/errors}}
                            </ul>
                        </template>
                    </div>
                </form>
            </div>
        </section>
    </amp-accordion>

    <form action-xhr="{{ route('admin.attributes.destroy', $attributeSet) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
