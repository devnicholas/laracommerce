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
                    <form action="{{ route('dashboard.promotion.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="automatic" class="custom-control-input" id="isAutomatic">
                                <label class="custom-control-label" for="isAutomatic">Automática</label>
                            </div>
                            <small class="text-muted">Se habilitado o usuário não precisará de um cupom para que a regra seja aplicada</small>
                        </div>
                        <div class="form-group">
                            <label>Cupom</label>
                            <input type="text" name="coupon" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Produtos associados</label>
                            <select name="products[]" class="form-control" multiple>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Segure Ctrl para selecionar vários. Deixe vazio para todos.</small>
                        </div>
                        <div class="form-group">
                            <label>Início</label>
                            <input type="date" name="startAt" class="form-control" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Fim</label>
                            <input type="date" name="endAt" class="form-control" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Limite</label>
                            <input type="number" name="limit" class="form-control" min="0" value="0">
                            <small class="text-muted">Deixe vazio para ilimitado.</small>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control">
                                <option value="percent">Porcentagem</option>
                                <option value="value">Valor Bruto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="value" class="form-control" min="0">
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