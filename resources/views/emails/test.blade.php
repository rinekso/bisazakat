@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Bisa Zakat
        @endcomponent
    @endslot
    {{-- Body --}}

    ## This is test mail

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}
        @endcomponent
    @endslot
@endcomponent