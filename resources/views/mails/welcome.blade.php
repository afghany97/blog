@component('mail::message')

welcome {{$user->name}} to my blogger ,
it's a open source blog and feel free to use it . 

@component('mail::button', ['url' => 'https://github.com/afghany97/blogger'])
here is the code
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
