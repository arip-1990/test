@extends('layouts.app')

@section('content')
    <div class="row">
        <form class="col-8 offset-2" action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-3 col-form-label">Название товара</label>
                <div class="col-9">
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="category_id" class="col-3 col-form-label">Категория</label>
                <div class="col-9">
                    <select class="form-select" name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="price" class="col-3 col-form-label">Цена</label>
                <div class="col-9">
                    <input type="number" name="price" class="form-control" id="price" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="description" class="col-3 col-form-label">Описание</label>
                <div class="col-9">
                    <textarea name="description" class="form-control" rows="3" id="description"></textarea>
                </div>
            </div>

            <div class="row text-end">
                <div class="col">
                    <button type="submit" class="btn btn-success">Создать товар</button>
                </div>
            </div>
        </form>
    </div>
@endsection
