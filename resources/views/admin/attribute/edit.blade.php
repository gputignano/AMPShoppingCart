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


        {{-- ATTRIBUTE VALUES --}}
        <amp-accordion id="attributes" expand-single-section animate>
            <section>
                <h2>{{ __('Default Attributes') }}</h2>

                <div>
                    <fieldset>
                        <label for="label">{{ __('Label') }}</label>
                        <input type="text" name="label" value="{{ $attribute->label }}">
                    </fieldset>
        
                    <fieldset disabled>
                        <label for="code">{{ __('Code') }}</label>
                        <input type="text" name="code" value="{{ $attribute->code }}">
                    </fieldset>
        
                    <fieldset>
                        <label for="type">{{ __('Type') }}</label>
                        <select name="type" disabled>
                            <option value="0">{{ __('--select--') }}</option>
                            @foreach ([
                                App\Models\EAVBoolean::class,
                                App\Models\EAVDecimal::class,
                                App\Models\EAVInteger::class,
                                App\Models\EAVSelect::class,
                                App\Models\EAVString::class,
                                App\Models\EAVText::class,
                            ] as $type)
                                <option value="{{ $type }}" {{ $attribute->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </fieldset>
        
                    <input type="submit" value="{{ __('Update') }}">
                </div>
            </section>

            @if ($attribute->type::$hasDefaultValues)
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
            
                        @if (!is_array($attribute->type::$hasDefaultValues))
                            <fieldset>
                                <label for="value">{{ __('Value') }}</label>
                                <input type="text" name="value">
                            </fieldset>
                        @endif

                        <input type="submit" value="{{ __('Update') }}">
                    </div>
                </section>
            @endif

            {{-- ENTITY TYPES --}}
            @if (\App\Models\EntityType::count())
                <section>
                    <h2>{{ __('Entity Types') }}</h2>

                    <div>
                        <ul>
                            @foreach (\App\Models\EntityType::all() as $entity_type)
                                <li><input type="checkbox" name="entity_types[]" value="{{ $entity_type->id }}" {{ $attribute->entity_types()->find($entity_type->id) ? 'checked' : '' }}>{{ $entity_type->label }}</li>
                            @endforeach
                        </ul>
                        <input type="submit" value="{{ __('Update') }}">
                    </div>
                </section>
            @endif

            {{-- ATTRIBUTE SETS --}}
            @if (\App\Models\AttributeSet::count())
                <section>
                    <h2>{{ __('Attribute Sets') }}</h2>

                    <div>
                        <ul>
                            @foreach (\App\Models\AttributeSet::all() as $attribute_set)
                                <li><input type="checkbox" name="attribute_sets[]" value="{{ $attribute_set->id }}" {{ $attribute->attribute_sets()->find($attribute_set->id) ? 'checked' : '' }}>{{ $attribute_set->label }}</li>
                            @endforeach
                        </ul>
                        <input type="submit" value="{{ __('Update') }}">
                    </div>
                </section>
            @endif
        </amp-accordion>

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Attribute updated successfully!') }}
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

    <form action-xhr="{{ route('admin.attributes.destroy', $attribute) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
