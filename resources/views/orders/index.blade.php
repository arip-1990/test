@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 text-end">
            <a class="btn btn-primary" href="{{ route('orders.create') }}">Создать заказ</a>
        </div>
        <div class="col-10 offset-1">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th>Покупатель</th>
                    <th>Статус</th>
                    <th>Сумма</th>
                    <th>Действия</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d.m.Y') }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            @if ($order->status === 'new')
                                <span class="badge rounded-pill text-bg-success">Новый</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Выполнен</span>
                            @endif
                        </td>
                        <td>{{ $order->total_price }} &#8381;</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('orders.show', $order) }}">Просмотр</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col-10 offset-1">{{ $orders->links() }}</div>
    </div>
@endsection
