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
                            Addresses
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                        <a class="btn btn-primary" href="{{ route('dashboard.address.create', request()->route()->parameters['user']) }}">
                            Adicionar
                        </a>
                    </div>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>CEP</th>
                            <th>Rua</th>
                            <th>Cidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->zip_code }}</td>
                            <td>{{ $item->street }}</td>
                            <td>{{ $item->city }}</td>
                            <td>
                                <form action="{{ route('dashboard.address.destroy', ['id' => $item->id, 'user' => request()->route()->parameters['user']]) }}" method="post">
                                    <a href="{{ route('dashboard.address.show', ['id' => $item->id, 'user' => request()->route()->parameters['user']]) }}" class="btn badge badge-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
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