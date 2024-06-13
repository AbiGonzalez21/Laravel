@extends('master')
@section('titulo','Listado de Productos')
@section('contenido')

<div class="container text-center">
<h1>Listado de Productos</h1>

<hr>
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Agregar</th>
    </tr>
  </thead>  
  <tbody>
    @foreach($productos as $producto)
    <tr>
        <td>{{$producto->nombre}}</td>
        <td>${{number_format($producto->precio,0)}}</td>
        <td>{{$producto->cantidad}}</td>
       
        <td>
          <a href="{{ route('carrito-agregar',$producto->id)}}">
          <i class="fa fa-shopping-cart fa-2x"></i>
        </td>
          <a/>
        </tr>
    @endforeach
  </tbody>
</table>

<hr>
</div>
@endsection