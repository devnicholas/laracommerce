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
                            Informações do Pedido
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                        @if($item->status == 'new')
                            <a href="{{ route('dashboard.order.update', ['id' => $item->id, 'status' => 'completed']) }}" class="btn btn-success">Completar</a>
                            <a href="{{ route('dashboard.order.update', ['id' => $item->id, 'status' => 'canceled']) }}" class="btn btn-danger">Cancelar</a>
                        @elseif($item->status == 'canceled')
                            <a href="{{ route('dashboard.order.update', ['id' => $item->id, 'status' => 'completed']) }}" class="btn btn-success">Completar</a>
                        @elseif($item->status == 'completed')
                            <a href="{{ route('dashboard.order.update', ['id' => $item->id, 'status' => 'canceled']) }}" class="btn btn-danger">Cancelar</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="text-bold mb-1">Informações gerais</p>
                        <p class="mb-1">Data de criação: {{$item->created_at->format('d/m/Y')}}</p>
                        <p class="mb-1">Cliente: {{json_decode($item->user_data)->name}} <br> Telefone: {{json_decode($item->user_data)->phone}}</p>
                        <p class="mb-1">Status: {{Helper::translateStatus($item->status)}}</p>
                        <p class="mb-1">Valor total: R$ {{Helper::numberFormat($item->value)}}</p>
                    </div>
                    <div class="col-6">
                        <p class="text-bold mt-3 mb-1">Produtos</p>
                        <ul>
                            @foreach(json_decode($item->products_data) as $product)
                                <li>
                                    {{ $product->product }}
                                    <ul>
                                        @foreach($product->attributes as $key => $value)
                                            <li>{{$key}}: {{$value}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-6">
                        <p class="text-bold mt-3 mb-1">Informações de entrega</p>
                        <p class="mb-1">Método de entrega: {{$item->shipping}}</p>
                        <p class="mb-1">Taxa: R$ {{Helper::numberFormat($item->shipping_value)}}</p>
                        @foreach(json_decode($item->shipping_data) as $key => $value)
                            <p class="mb-1">{{Helper::translateShippingValue($key)}}: {{$value}}</p>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection