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
                        <li class="list-group-item">
                            2. <a href="{{ route('select2-livewire') }}">Componente Select2 Livewire</a>
                        </li>                        
                        <li class="list-group-item">
                            3. <a href="{{ route('select2-livewire-componentes') }}">Select2 Cascada 3 Niveles Livewire</a>
                        </li>                        
                    </ol>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
