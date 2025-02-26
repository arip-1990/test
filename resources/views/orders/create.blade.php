@extends('layouts.app')

@section('content')
    <div class="row">
        <form class="col-8 offset-2" action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="text" name="customer_name" placeholder="ФИО покупателя" required>
            <select name="product_id" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->price }} &#8381;)</option>
                @endforeach
            </select>
            <input type="number" name="quantity" min="1" value="1" required>
            <textarea name="note" placeholder="Комментарий"></textarea>
            <button type="submit">Создать заказ</button>
        </form>
    </div>
@endsection
