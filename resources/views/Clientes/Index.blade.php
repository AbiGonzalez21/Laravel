@extends('master')
@section('contenido')

<p>Listado De Clientes</p>

<!-- Button insert cliente modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createClienteModal">
            Crear Nuevo Cliente
        </button>
        <!--FORMULARIO DE BUSQUEDA  -->
        {!! Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-form'])
            !!}
            <div class="form-group">
                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre',
                    'placeholder'=>'Buscar Cliente']) !!}
                    {!!Form::submit('Buscar Cliente',array('class'=>'btn btn-primary'))!!}
            </div>
            {!!Form::close() !!}
           
<p> </p>
<table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">Actualizar</th>
      <th scope="col">Eliminar</th>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Rfc</th>
      <th scope="col">Direccion</th>
      <th scope="col">Telefono</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  @foreach($clientes as $cliente)
  <tr>
    <td>
      <!--Boton update cliente Modal-->
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateClienteModal{{$cliente->id}}">
        <i class="bi bi-repeat"></i>
      </button>
    </td>
    <td>
      {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE' ])!!}
      <!--Boton delete cliente Modal-->
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteClienteModal{{$cliente->id}}">
          <i class="bi bi-trash3-fill"></i>
      </button>
      {!! Form::close() !!}
    </td>
    <td>{{ $cliente->id }}</td>
    <td>{{ $cliente->nombre }}</td>
    <td>{{ $cliente->rfc }}</td>
    <td>{{ $cliente->direccion }}</td>
    <td>{{ $cliente->telefono }}</td>
    <td>{{ $cliente->email }}</td>
  </tr>
  <!-- Modal update clientes -->
  <div class="modal fade" id="updateClienteModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="updateClienteModalLabel{{$cliente->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateClienteModalLabel{{$cliente->id}}">Actualizar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                {!! Form::model($cliente, ['route' => ['clientes.update', $cliente->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Nombre del cliente...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('rfc', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'RFC...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('direccion', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Direcccion...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('telefono', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Telefono...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('email', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Email...'
                        )) !!}
                    </div>
                    {!! Form::submit('Actualizar Cliente', array('class'=>'btn btn-success')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  @endforeach
</table>
{{ $clientes->links()}}
<hr>


    <!-- Modal Create Cliente -->
    <div class="modal fade" id="createClienteModal" tabindex="-1" role="dialog" aria-labelledby="createClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createClienteModalLabel">Crear Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'clientes.store']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Nombre del cliente...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('rfc', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'RFC...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('direccion', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Direcccion...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('telefono', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Telefono...'
                        )) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('email', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Email...'
                        )) !!}
                    </div>
                    {!! Form::submit('Guardar Cliente', array('class'=>'btn btn-success'))!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar un cliente -->
    @foreach($clientes as $cliente)
    <div class="modal fade" id="deleteClienteModal{{$cliente->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteClienteModalLabel{{$cliente->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteClienteModalLabel{{$cliente->id}}">Eliminar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar el cliente "{{ $cliente->nombre }}"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
