@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('SELECT2') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- inicio form select --}}
                    <form>
                        <fieldset>
                            <legend>Estilos y configuración select2</legend>
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">Select normal</label>
                                <select id="disabledSelect" class="form-select">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="select2" class="form-label">Select2</label>
                                <select class="form-control mi-select" name="state" id="select2">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
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

{{-- Definición de scripts
se cargarán en app --}}
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
    </script>
@endpush