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
                            Editar produto
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.product.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $item->slug }}">
                        </div>
                        <div class="form-group">
                            <label>Imagem</label>
                            <div><a href="{{ url('storage/products/'.$item->image) }}" target="_blank">Ver imagem atual</a></div>
                            <input type="file" name="image" class="form-control">
                            <small class="form-text text-muted">Se não for atualizar deixar vazio o campo</small>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Estoque</label>
                            <input type="number" name="qty" class="form-control" value="{{ $item->qty }}" />
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="text" name="price" data-mask="#.##0.00" data-mask-reverse="true" class="form-control" value="{{ Helper::numberFormat($item->price) }}" />
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="category_id" class="form-control">
                                <option value>Selecione</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                      {{ $item->category && $item->category->id == $cat->id ? 'selected' : ''}}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="collapse" id="attributesCollapse">
                            @foreach($attributes as $attr)
                            <div class="form-group">
                                <label>{{$attr->name}}</label>
                                <input type="text" name="attributes[{{$attr->id}}]" class="form-control" 
                                    value="{{ Helper::getAttributeFromProduct($item, $attr->id) }}" />
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#attributesCollapse">Ver atributos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection