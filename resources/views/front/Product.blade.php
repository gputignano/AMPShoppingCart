@extends('front.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('meta_description', $rewrite->meta_description)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div class="flex flex-wrap">
        <div class="col-12 md-col-6">
            <amp-img
                alt="{{ __('Image Alt') }}"
                src="https://picsum.photos/320"
                width="320"
                height="320"
                layout="responsive"
            ></amp-img>
        </div>

        <div class="col-12 md-col-6">
            <div>
                <div>
                    {{ __('Price: ') . $entity->price }}
                </div>
            
                <div>
                    {{ __('Quantity: ') . $entity->quantity }}
                </div>
    
                <div>
                    <form action-xhr="{{ route('cart.store') }}" method="post">
                        @csrf
                
                        <input type="hidden" name="id" value="{{ $entity->id }}">
                        <input type="hidden" name="name" value="{{ $entity->name }}">
                        <input type="hidden" name="price" value="{{ $entity->price }}">
                
                        <input type="submit" value="{{ __('Add to Cart') }}" class="btn btn-primary bg-orange col-12 md-col-6">
                
                        <div submit-error>
                            ERROR!
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h2>{{ __('Description') }}</h2>
    <div>{{ $entity->description }}</div>

    <h2>{{ __('More Info') }}</h2>
    <div>
        @foreach ($entity->attributes()->isVisibleOnFront(true)->get() as $attribute)
            <div>{{ $attribute->label }}: {{ $entity->{$attribute->code} }}</div>
        @endforeach
    </div>
@endsection
