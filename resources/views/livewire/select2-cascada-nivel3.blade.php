<div>
    {{ isset($distrito) ? $distrito : '...' }}
    {{-- {{ isset($provincia) ? $provincia : '...' }}
    {{ isset($comuna) ? $comuna : '...' }} --}}
    {{-- <livewire:select-distrito /> --}}

    @livewire('select-distrito')
    @livewire('select-provincia')

</div>