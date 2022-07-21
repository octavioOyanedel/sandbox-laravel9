@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('LISTA DE COMPONENTES') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ol class="list-group">
                        <li class="list-group-item">
                            1. <a href="{{ route('select2') }}">Estilos y configuración select2</a>
                        </li>
                    </ol>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
