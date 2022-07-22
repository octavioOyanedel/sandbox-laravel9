@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('SELECT2 COMPONENTES') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- inicio form select --}}
                    <form>
                        <fieldset>
                            <legend>Componente Select2 Livewire</legend>

                            {{-- <livewire:select2-cascada-nivel3 /> --}}
                            @livewire('select2-cascada-nivel3')
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </fieldset>
                    </form>
                    {{-- fin form select --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.mi-select').select2({
                // select2 responsivo, se ajusta a contenedor padre
                width: '100%',
                // traducción
                language: {
                    noResults: function() {
                        return "Sin coincidencias.";        
                    },
                    searching: function() {
                        return "Buscando..";
                    }
                }
            });
        });

        $('.select-distrito').on('change', function (e) {
            var id = $(this).select2("val");
            // emite evento select2 con parámetro id a componente
            Livewire.emit('eventoSelectDistrito', id);
        });
        // $('.select-provincia').on('change', function (e) {
        //     var id = $(this).select2("val");
        //     // emite evento select2 con parámetro id a componente
        //     Livewire.emit('eventoSelectProvincia', id);
        // });        
    </script>
@endpush