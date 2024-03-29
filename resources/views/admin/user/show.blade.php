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
                            Editar registro
                        </p>
                    </div>
                    <div class="actions text-right w-50">
                        <a class="btn btn-primary" href="{{ route('dashboard.address.index', $item->id) }}">
                            Endereços
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.user.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" class="form-control" value="{{ $item->email }}">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Deixe em branco para não atualizar</small>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="admin" class="custom-control-input" id="isAdmin" {{ $item->admin ? 'checked' : ''}}>
                            <label class="custom-control-label" for="isAdmin">Administrador</label>
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