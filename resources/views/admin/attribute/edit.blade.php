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

    {{-- ATTRIBUTE VALUES --}}
    <amp-accordion id="attributes" expand-single-section animate>
        <section>
            <h2 class="p1">{{ __('General') }}</h2>

            <div class="mt2">
                <form method="post" action-xhr="{{ route('admin.attributes.update', $attribute) }}">
                    @csrf
                    @method('patch')
    
                    <div>
                        <label for="label" class="label">{{ __('Label') }}</label>
                        <input type="text" id="label" name="label" value="{{ $attribute->label }}" class="input border-green">
                    </div>
        
                    <div>
                        <label for="code" class="label">{{ __('Code') }}</label>
                        <input type="text" id="code" name="code" value="{{ $attribute->code }}" class="input border-red" disabled>
                    </div>
        
                    <div>
                        <label for="type" class="label">{{ __('Type') }}</label>
                        <input type="text" id="type" name="type" value="{{ class_basename($attribute->type) }}" class="input border-red" disabled>
                    </div>
    
                    <div>
                        <label for="is_system" class="label">
                            <input type="checkbox" id="is_system" name="is_system" {{ $attribute->checked($attribute, 'is_system') }} class="checkbox">
                            {{ __('Is System') }}
                        </label>
                    </div>
        
                    <div>
                        <label for="is_visible_on_front" class="label">
                            <input type="checkbox" id="is_visible_on_front" name="is_visible_on_front" class="checkbox" {{ $attribute->checked($attribute, 'is_visible_on_front') }}>
                            {{ __('Is Visible on Front') }}
                        </label>
                    </div>
    
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary col-12 btn-big">
    
                    @include('admin.inc.response')
                </form>
            </div>
        </section>

        @if ($attribute->type::$hasDefaultValues)
        <section>
            <h2 class="p1">{{ __('Attribute Values') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.attributes.update', $attribute) }}">
                    @csrf
                    @method('patch')
    
                    <ul>
                        @forelse ($attribute->values as $value)
                            <li>
                                {{ $value->value }}
                            </li>
                        @empty
                            <li>{{ __('No attribute found') }}</li>
                        @endforelse
                    </ul>
        
                    @if ($attribute->type::$hasDefaultValues)
                        <div>
                            <label for="value" class="label">{{ __('Value') }}</label>
                            <input type="text" id="value" name="value" class="input">
                        </div>
                    @endif
    
                    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary col-12 btn-big">
    
                    @include('admin.inc.response')
                </form>
            </div>
        </section>
        @endif

        <section class="mt2">
            <h2 class="p1">{{ __('Delete Attribute') }}</h2>

            <div class="mt2">
                <form action-xhr="{{ route('admin.attributes.destroy', $attribute) }}" method="post">
                    @csrf
                    @method('delete')
            
                    <input type="submit" value="{{ __('Delete') }}" class="btn btn-primary col-12 bg-red btn-big" {{ $attribute->products->count() ? 'disabled' : '' }}>
                </form>
            </div>
        </section>
    </amp-accordion>
@endsection
