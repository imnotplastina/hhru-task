@extends('layouts.app')

@section('content')
    <h1>Товары</h1>
    <a href="{{ route('products.create') }}">Добавить товар</a>
    <ul>
        @foreach ($products as $product)
            <li>
                {{ $product->name }} - {{ $product->price }} руб.
                <a href="{{ route('products.edit', $product->id) }}">Редактировать</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
