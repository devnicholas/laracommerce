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
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.promotion.update', $item->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="automatic" class="custom-control-input" id="isAutomatic" {{$item->automatic?'checked':''}}>
                                <label class="custom-control-label" for="isAutomatic">Automática</label>
                            </div>
                            <small class="text-muted">Se habilitado o usuário não precisará de um cupom para que a regra seja aplicada</small>
                        </div>
                        <div class="form-group">
                            <label>Cupom</label>
                            <input type="text" name="coupon" class="form-control" value="{{$item->coupon}}">
                        </div>
                        <div class="form-group">
                            <label>Produtos associados</label>
                            <select name="products[]" class="form-control" multiple>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" {{$item->inPromotion($prod->id) ? 'selected' : ''}}>
                                        {{ $prod->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Segure Ctrl para selecionar vários. Deixe vazio para todos.</small>
                        </div>
                        <div class="form-group">
                            <label>Início</label>
                            <input type="date" name="startAt" class="form-control" min="{{ date('Y-m-d') }}" value="{{$item->startAt->format('Y-m-d')}}">
                        </div>
                        <div class="form-group">
                            <label>Fim</label>
                            <input type="date" name="endAt" class="form-control" min="{{ date('Y-m-d') }}" value="{{$item->endAt->format('Y-m-d')}}">
                        </div>
                        <div class="form-group">
                            <label>Limite</label>
                            <input type="number" name="limit" class="form-control" min="0" value="{{$item->limit}}">
                            <small class="text-muted">Deixe vazio para ilimitado.</small>
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control">
                                <option value="percent" {{$item->type=='percent' ? 'selected':''}}>Porcentagem</option>
                                <option value="value" {{$item->type=='value' ? 'selected':''}}>Valor Bruto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="value" class="form-control" min="0" value="{{ $item->value }}">
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