@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('TOM SELECT') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- inicio form select --}}
                    <form>
                        <fieldset>
                            <legend>Testeo de TOM SELECT Bootstrap 5</legend>
                            @livewire('tom-select')
                            @livewire('tom-select2')
                            {{-- <button type="submit" class="btn btn-primary">Enviar</button> --}}
                        </fieldset>
                    </form>
                    {{-- fin form select --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Definición de scripts
se cargarán en app --}}
@push('scripts')
    <script type="text/javascript">
        new TomSelect("#select-beast",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            render: {
                no_results:function(data,escape){
                    return '<div class="no-results">Sin resultados para "'+escape(data.input)+'"</div>';
                },
                option_create: function(data, escape) {
                    return '<div class="create">Agregars <strong>' + escape(data.input) + '</strong>&hellip;</div>';
                },
            }
        });
    </script>
    <script type="text/javascript">
        new TomSelect("#select-beast2",{
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            render: {
                no_results:function(data,escape){
                    return '<div class="no-results">Sin resultados para "'+escape(data.input)+'"</div>';
                },
                option_create: function(data, escape) {
                    return '<div class="create">Agregars <strong>' + escape(data.input) + '</strong>&hellip;</div>';
                },
            }
        });
    </script> 
    <script>
        $("#select-beast").on('change', function (e) {
            id = $( "#select-beast option:selected" ).val();
            Livewire.emit('eventoSelectDistrito', id);
        });   
    </script>
@endpush