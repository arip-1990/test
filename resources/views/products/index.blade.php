@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 text-end">
            <a class="btn btn-primary" href="{{ route('products.create') }}">Добавить товар</a>
        </div>

        <div class="col-10 offset-1">
            <table class="table table-striped">
                <tr>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Категория</th>
                    <th>Действия</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }} &#8381;</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('products.show', $product) }}">Просмотр</a>
                            <a class="btn btn-success" href="{{ route('products.edit', $product) }}">Редактировать</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col-10 offset-1">{{ $products->links() }}</div>
    </div>
@endsection
