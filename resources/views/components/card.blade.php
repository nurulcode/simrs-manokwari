<div class="card {{ $class ?? '' }}">

    @isset($header)
        <div class="card-header">{{ $header }}</div>
    @endisset

    <div class="card-body">

        @isset($title)
            <{{ $title_tag ?? 'h4' }} class="card-title">{{ $title }}</{{ $title_tag ?? 'h4'}}>
        @endisset

        {{ $slot }}

    </div>
</div>