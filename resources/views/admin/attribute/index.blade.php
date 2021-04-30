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
                            Atributo
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                        <a class="btn btn-primary" href="{{ route('dashboard.attribute.create') }}">
                            Criar atributo
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
                        @foreach($items as $attribute)
                        <tr>
                            <td>#{{ $attribute->id }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>
                                <form action="{{ route('dashboard.attribute.destroy', $attribute->id) }}" method="post">
                                    <a href="{{ route('dashboard.attribute.show', $attribute->id) }}" class="btn badge badge-primary">
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