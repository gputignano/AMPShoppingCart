@extends('admin.layouts.main')

@section('meta_title', __('Edit Attribute'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit Attribute') }}</h1>

    <form method="post" action-xhr="{{ route('admin.attributes.update', $attribute) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="label">{{ __('Label') }}</label>
            <input type="text" name="label" id="label" value="{{ $attribute->label }}">
        </fieldset>

        <fieldset>
            <label for="type">{{ __('Type') }}</label>
            <select name="type">
                <option value="0">{{ __('--select--') }}</option>
                @foreach (['App\Models\EAVBoolean', 'App\Models\EAVDecimal', 'App\Models\EAVInteger', 'App\Models\EAVString', 'App\Models\EAVText'] as $type)
                    <option value="{{ $type }}" {{ $attribute->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </fieldset>

        <amp-accordion id="attributes" expand-single-section animate>
            <section>
                <h2>{{ __('Attribute Values') }}</h2>
   
                <div>
                    <ul>
                        @forelse ($attribute->values as $value)
                            <li>{{ $value->value }}</li>
                        @empty
                            <li>{{ __('No attribute found') }}</li>
                        @endforelse
                    </ul>
        
                    <input type="text" name="value">
                </div>
            </section>

            @if (\App\Models\EntityType::count())
                <section>
                    <h2>{{ __('Entity Types') }}</h2>

                    <div>
                        <ul>
                            @foreach (\App\Models\EntityType::all() as $entity_type)
                                <li><input type="checkbox" name="entity_types[]" value="{{ $entity_type->id }}" {{ $attribute->entity_types()->find($entity_type->id) ? 'checked' : '' }}>{{ $entity_type->label }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            @endif
        </amp-accordion>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('User updated successfully!') }}
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
@endsection
