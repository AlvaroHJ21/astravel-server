<x-mail::message>
# Reset password

The body of your message.

<x-mail::button :url="$url">
Reset
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

