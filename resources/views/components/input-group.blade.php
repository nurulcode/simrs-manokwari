<div class="input-group">

    @isset($prepend)
        <div class="input-group-prepend"> {{ $prepend }} </div>
    @endisset

    {{ $slot }}

    @isset($append)
        <div class="input-group-append"> {{ $append }} </div>
    @endisset

</div>