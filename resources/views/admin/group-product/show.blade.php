@extends('adminlte::page')

@section('js')
<script>
    $('input[name=name]').on('focusout', function(){
        $('input[name=slug]').val($(this).val().replace(/[^a-zA-Z0-9]+/g,'-').toLowerCase())
    })
</script>
@endsection
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
                    <form action="{{ route('dashboard.group-product.update', $item->id) }}" method="post" enctype="multipart/form-data">
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
                            @include('components.upload', ['name' => 'image', 'value' => url('storage/products/'.$item->image)])
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="categories[]" class="form-control" multiple>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                      {{ in_array($cat->id, $item->categories()->allRelatedIds()->toArray()) ? 'selected' : ''}}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Produtos associados</label>
                            <select name="products[]" class="form-control" multiple>
                                @foreach($products as $prod)
                                    <option value="{{ $prod->id }}" {{$item->inGroup($prod->id) ? 'selected' : ''}}>
                                        {{ $prod->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Segure Ctrl para selecionar vários</small>
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