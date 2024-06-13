@extends('master')
@section('titulo', 'Carrito')

@section('contenido')
<div class="container text-center">
    <h1>Carrito de items</h1>
    <p>
        <a href="{{ route('carrito-vaciar') }}" class="btn btn-danger rounded-pill">
            Vaciar Carrito <i class="bi bi-tornado"></i>
        </a>
    </p>
    <hr>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
        @foreach($carrito as $item)
            <tr>
                <td>{{ $item->nombre }}</td>
                <td>${{ number_format($item->precio, 0) }}</td>
                <td>
                    <input type="number" min="1" max="50" value="{{ $item->cantidad }}" id="producto_{{ $item->id }}">
                    <a href="#" class="btn btn-warning btn-update-item rounded-pill " data-href="{{ route('carrito-actualizar', $item->id) }}" data-id="{{ $item->id }}">
                        <i class="bi bi-repeat"></i>
                    </a>
                </td>
                <td>{{ $item->precio * $item->cantidad }}</td>
                <td>
                    <a href="{{ route('carrito-borrar', $item->id) }}">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3> <span class="label label-success">${{ number_format($total)}}
    </span></h3>
    <p>
        <a href="{{ route('productos.index') }}">
            <i class="bi bi-bag-check-fill"></i> Seguir Agregando
        </a>
        @if(count($carrito))
        <a class="btn btn-success rounded-pill" href="{{ route('ordenar')}}">
            Ordenar <i class="bi bi-bag-check-fill"></i>
        </a>
        @endif
    </p>
</div>
@endsection