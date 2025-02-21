<form action="{{ route('orders.complete', $order->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Завершить заказ</button>
</form>
