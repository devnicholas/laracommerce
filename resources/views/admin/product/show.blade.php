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
                            @include('components.upload', ['name' => 'image', 'value' => url('storage/products/'.$item->image)])
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
                            <select name="categories[]" class="form-control" multiple>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" 
                                      {{ in_array($cat->id, $item->categories()->allRelatedIds()->toArray()) ? 'selected' : ''}}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($attributes as $attr)
                        <div class="form-group">
                            <label>{{$attr->name}}</label>
                            <select name="attributes[{{$attr->id}}]" id="attribute-{{$attr->id}}" class="form-control">
                                <option value>Selecione</option>
                                @foreach(json_decode($attr->values) as $value)
                                    <option value="{{$value}}" {{ $value == Helper::getAttributeFromProduct($item, $attr->id) ? 'selected' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
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