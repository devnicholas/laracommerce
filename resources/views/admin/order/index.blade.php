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
                            Pedidos
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                    </div>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ json_decode($item->user_data)->name }}</td>
                            <td>{{ Helper::translateStatus($item->status) }}</td>
                            <td>{{$item->created_at->format('d/m/Y')}}</td>
                            <td>
                                <a href="{{ route('dashboard.order.show', $item->id) }}" class="btn badge badge-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection