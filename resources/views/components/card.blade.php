<div class="card {{ $class ?? '' }}">

    @isset($header)
        <div class="card-header" v-b-toggle.{{ $rand = uniqid() }}>
            {{ $header }}
        </div>
    @endisset

    <b-collapse id="{{ $rand }}" visible>
        <div class="card-body">

            @isset($title)
                <{{ $title_tag ?? 'h4' }} class="card-title">{{ $title }}</{{ $title_tag ?? 'h4'}}>
            @endisset

            {{ $slot }}

        </div>
    </b-collapse>

    @if(isset($footer) && !empty($footer->toHtml()))
        <div class="card-footer">{{ $footer }}</div>
    @endif
</div>