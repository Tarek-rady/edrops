@component('mail::message')

{{ __('models.sendCode') }}

@component('mail::panel')
{{ $details['title'] }}

@endcomponent

@endcomponent
