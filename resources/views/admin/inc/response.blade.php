<div submitting>
    <template type="amp-mustache">
        {{ __('Submitting...') }}
    </template>
    </div>

    <div submit-success>
    <template type="amp-mustache">
        {{ __('Updated successfully!') }}
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
