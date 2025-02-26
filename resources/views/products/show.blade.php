@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <table class="table table-striped">
                <tr>
                    <td class="fw-bold">ID:</td>
                    <td>{{ $product->id }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Категория:</td>
                    <td>{{ $product->category->name }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Название:</td>
                    <td>{{ $product->name }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Описание:</td>
                    <td>{{ $product->description }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Цена:</td>
                    <td>{{ $product->price }} &#8381;</td>
                </tr>

                <tr>
                    <td class="fw-bold">ID:</td>
                    <td>{{ $product->id }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Дата добавления:</td>
                    <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
