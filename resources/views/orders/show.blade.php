@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <h3>Заказ #{{ $order->id }}</h3>
        </div>

        <div class="col-10 offset-1">
            <table class="table table-striped">
                <tr>
                    <td class="fw-bold">Покупатель:</td>
                    <td>{{ $order->customer_name }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Дата:</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Товар:</td>
                    <td>{{ $order->product->name }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Количество:</td>
                    <td>{{ $order->quantity }}</td>
                </tr>

                <tr>
                    <td class="fw-bold">Сумма:</td>
                    <td>{{ $order->total_price }} &#8381;</td>
                </tr>

                <tr>
                    <td class="fw-bold">Статус:</td>
                    <td>
                        @if ($order->status === 'new')
                            <span class="badge rounded-pill text-bg-success">Новый</span>
                        @else
                            <span class="badge rounded-pill text-bg-secondary">Выполнен</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="fw-bold">Комментарий:</td>
                    <td>{{ $order->note ?? 'Отсутствует' }}</td>
                </tr>
            </table>
        </div>

        <div class="col-10 offset-1 text-end">
            @if ($order->status === 'new')
                <form action="{{ route('orders.complete', $order) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">Отметить выполненным</button>
                </form>
            @endif
        </div>
    </div>
@endsection
