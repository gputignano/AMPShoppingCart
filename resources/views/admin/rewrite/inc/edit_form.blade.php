{{-- REWRITES --}}
<section>
    <h2>{{ __('Rewrites') }}</h2>

    <div>
        <form method="post" action-xhr="{{ $entity->rewrite()->count() ? route('admin.rewrites.update', $entity) : route('admin.rewrites.store') }}">
            @csrf
            @method($entity->rewrite()->count() ? 'patch' : 'post')

            <input type="hidden" name="entity_type" value="{{ get_class($entity) }}">
            <input type="hidden" name="entity_id" value="{{ $entity->id }}">

            <fieldset>
                <label for="slug">{{ __('Slug') }}</label>
                <input type="text" name="slug" value="{{ $entity->rewrite->slug ?? null }}">
            </fieldset>

            <fieldset>
                <label for="meta_title">{{ __('Meta Title') }}</label>
                <input type="text" name="meta_title" value="{{ $entity->rewrite->meta_title ?? null }}">
            </fieldset>

            <fieldset>
                <label for="meta_description">{{ __('Meta Description') }}</label>
                <textarea name="meta_description" cols="30" rows="10">{{ $entity->rewrite->meta_description ?? null }}</textarea>
            </fieldset>

            <fieldset>
                <label for="meta_robots">{{ __('Meta Robots') }}</label>
                <input type="text" name="meta_robots" value="{{ $entity->rewrite->meta_robots ?? 'noindex,nofollow' }}">
            </fieldset>

            <fieldset>
                <label for="is_active">{{ __('Active') }}</label>
                <input type="checkbox" name="is_active" {{ $entity->rewrite->is_active ?? null ? 'checked' : '' }}>
            </fieldset>

            <input type="submit" value="{{ __('Update') }}">

            @include('admin.inc.response')
        </form>

        @if ($entity->rewrite()->count())
            <form action-xhr="{{ route('admin.rewrites.destroy', $entity->rewrite) }}" method="post">
                @csrf
                @method('delete')
        
                <input type="submit" value="{{ __('Delete') }}">
            </form>
        @endif
    </div>
</section>
