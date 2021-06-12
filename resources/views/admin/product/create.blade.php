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
                            Criar novo produto
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Imagem</label>
                            @include('components.upload', ['name' => 'image'])
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Estoque</label>
                            <input type="number" name="qty" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="text" name="price" data-mask="#.##0.00" data-mask-reverse="true" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="category_id" class="form-control">
                                <option value>Selecione</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($attributes as $attr)
                        <div class="form-group">
                            <label>{{$attr->name}}</label>
                            <input type="text" name="attributes[{{$attr->id}}][value]" class="form-control" />
                        </div>
                        @endforeach
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