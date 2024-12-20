@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'text-lg text-red-600 space-y-1']) }}>
        <ul>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>     
@endif
