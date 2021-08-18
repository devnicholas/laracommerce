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
                            Ordenar categoria
                        </p>
                    </div>

                    <div class="actions text-right w-50">
                        <button class="btn btn-primary" id="saveCategory">
                            Salvar
                        </button>
                    </div>
                </div>
                <ul id="simpleList" class="list-group">
                    @foreach($items as $item)
                    <li class="list-group-item" data-id="{{$item['id']}}" data-type="{{ empty($item['price']) ? 'group' : 'single' }}">
                        <i class="fas fa-arrows-alt handle"></i>&nbsp;&nbsp;
                        {{$item['name']}}
                        @if (empty($item['price']))
                            <span class="text-muted">[Produto agrupado]</span> 
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            <p class="text-right text-muted"><small>Arraste para mudar a ordem</small></p>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ url('vendor/sortable/sortable.js') }}"></script>
    <script>
        Sortable.create(simpleList, {
            handle: '.handle', // handle's class
            animation: 150
        });
        $('#saveCategory').on('click', function() {
            const items = []
            $('#simpleList li').each(function(index, item) {
                const type = $(item).data('type')
                const id = $(item).data('id')
                items.push([id, type]);
            });
            $.post({
                url: '{{ route("dashboard.category.order", $category->id) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    items
                },
                success: function(res) {
                    alert('Categoria salva com sucesso')
                },
                error: function(err) {
                    alert('Ocorreu um erro ao salvar, tente novamente')
                }
            })
        })
    </script>
@endsection