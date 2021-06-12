@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('components.alerts')
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="title w-50">
                        <p class="mb-0 text-bold">
                            Editar atributo
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.attribute.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label>Valores</label>
                            <textarea class="form-control" name="values">{{ implode(', ', json_decode($item->values)) }}</textarea>
                            <small class="text-muted">Valores separados por vírgula. Ex.: Vermelho, Azul, Verde</small>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection