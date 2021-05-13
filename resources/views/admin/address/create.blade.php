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
                            Criar novo registro
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.address.store', request()->route()->parameters['user']) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" name="zip_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Rua</label>
                            <input type="text" name="street" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" name="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" name="region" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <input type="text" name="state" class="form-control">
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