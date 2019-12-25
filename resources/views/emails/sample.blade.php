@component('mail::message')
# Hi, {{ $user->name }}

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam dignissimos molestiae eaque, corporis natus ipsum recusandae unde eligendi architecto voluptas consequatur placeat quod fugiat nisi alias nemo quasi. Perferendis, dolores?

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
