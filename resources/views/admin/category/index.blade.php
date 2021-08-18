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
                            Categoria
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                        <a class="btn btn-primary" href="{{ route('dashboard.category.create') }}">
                            Criar categoria
                        </a>
                    </div>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nome</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $category)
                        <tr>
                            <td>#{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="post">
                                    <a href="{{ route('dashboard.category.show', $category->id) }}" class="btn badge badge-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn badge badge-danger">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <a href="{{ route('dashboard.category.order', $category->id) }}" class="btn badge badge-secondary">
                                        <i class="fas fa-sort-amount-down"></i>
                                    </a>
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