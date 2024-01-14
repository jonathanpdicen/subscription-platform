<x-mail::message>
# {{ $post->title }}

{{ $post->description }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
