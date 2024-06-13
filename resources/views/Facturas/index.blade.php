@extends('master')
@section('contenido')
<p>Listado de Facturas</p>
<!--Boton insertar Facturas Modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createFacturaModal">
            Crear Nueva Factura
        </button>
        <p></p>
        {!! Form::open(['route'=>'facturas.index','method'=>'GET','class'=>'navbar-form']) !!}
<div class="form-group rounded-pill">
    {!! Form::submit('Buscar Factura', ['class'=>'btn btn-primary','style'=>'border-radius: 20px;']) !!}
    <p></p> 
    {!! Form::text('numero', null, ['class'=>'form-control', 'id'=>'numero', 'placeholder'=>'Buscar Factura','style'=>'border-radius: 20px;']) !!}
</div>
{!! Form::close() !!}
<p> </p>
<table class="table table-success table-striped">
  <thead>
    <tr>
    <!--Comlumnas de la tabla -->
      <th scope="col">Actualizar</th>
      <th scope="col">Eliminar</th>
      <th scope="col">Numero</th>
      <th scope="col">Detalles</th>
      <th scope="col">Valor</th>
      <th scope="col">Archivo</th>
      <th scope="col">IdCliente</th>
      <th scope="col">IdForma</th>
      <th scope="col">IdEstado</th>
    </tr>
  </thead>
  @foreach($facturas as $factura)
  <tr>
    <td>
      <!--Boton update Factura Modal-->
      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateFacturaModal{{$factura->id}}">
        <i class="bi bi-repeat"></i>
      </button>
    </td>
    <td>
    <!--Boton delete factura Modal-->
    {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE' ])!!}
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFacturaModal{{$factura->id}}">
          <i class="bi bi-trash3-fill"></i>
      </button>
      {!! Form::close() !!}
    </td>
    <!--Datos de la tabla Facturacion -->
    <td>{{ $factura->numero }}</td>
    <!--Se cambia las {} por !! Para mostrar el HTML normal-->
    <td>{!! $factura->detalles !!}</td>
    <td>{{ $factura->valor }}</td>
    <td><img src="{{asset('archivos/'.$factura->archivo.'')}}" width="150"></td>
    <td>{{ $factura->cliente->nombre }}</td>
    <td>{{ $factura->formapago->nombre}}</td>
    <td>{{ $factura->estadofactura->nombre }}</td>
  </tr>

  <!-- Modal update clientes -->
<div class="modal fade" id="updateFacturaModal{{$factura->id}}" tabindex="-1" role="dialog" aria-labelledby="updateFacturaModalLabel{{$factura->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFacturaModalLabel{{$factura->id}}">Actualizar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                {!! Form::model($factura, ['route' => ['facturas.update', $factura->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::text('numero', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Numero Factura...'
                        )) !!}
                    </div>
                    <div class="form-group">
                    <label>Detalles</label>
                     <!-- Textarea para los detalles -->
                     <textarea class="form-control" id="editor2{{$factura->id}}" name="detalles" rows="3" required>{!! $factura->detalles !!}</textarea>
                     <script>
                        CKEDITOR.replace( 'editor2{{$factura->id}}' );
                     </script>
                    </div>
                    <div class="form-group">
                        {!! Form::text('valor', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Valor Factura...'
                        )) !!}
                    </div>
                    <div class="form-gruop">
                       {!! Form::file('archivo', ['class' => 'form-control-file']) !!}
                    </div>
                    <div class="form-gruop">
                        <label>Clientes</label>
                        {!! Form::select('idcliente', $clientes  , null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-gruop">
                        <label>Formas Pago</label>
                        {!! Form::select('idforma', $formaspago, null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-gruop">
                        <label>Estados</label>
                        {!! Form::select('idestado', $estadosfacturas, null,['class' => 'form-control']) !!}
                    </div>
                    <br>
                    {!! Form::submit('Actualizar Cliente', array('class'=>'btn btn-success')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  @endforeach
</table>
{{ $facturas->links()}}
<hr>

<!-- Modal Insert -->
<div class="modal fade" id="createFacturaModal" tabindex="-1" role="dialog" aria-labelledby="createFacturaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFacturaModalLabel">Crear Factura</h5>
                    <button type="button" class="close" data-dismisss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'facturas.store','method' => 'POST', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::text('numero', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Numero factura...'
                        )) !!}
                    </div>
                
                <label>Detalles</label>
                <textarea name="detalles" id="editor1" cols="30" rows="10" required></textarea>
                 <script>
                        CKEDITOR.replace( 'editor1' );
                 </script>
                <br>
                    <div class="form-group">
                        {!! Form::text('valor', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Valor Factura...'
                        )) !!}
                    </div>
                    <div class="form-gruop">
                       {!! Form::file('archivo'); !!}
                    </div>
                    <div class="form-gruop">
                        <label>Clientes</label>
                        {!! Form::select('idcliente', $clientes  , null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-gruop">
                        <label>Formas Pago</label>
                        {!! Form::select('idforma', $formaspago, null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-gruop">
                        <label>Estados</label>
                        {!! Form::select('idestado', $estadosfacturas, null,['class' => 'form-control']) !!}
                    </div>
                    <br>
                    {!! Form::submit('Guardar Factura', array('class'=>'btn btn-success'))!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

     <!-- Modal para eliminar un cliente -->
     @foreach($facturas as $factura)
    <div class="modal fade" id="deleteFacturaModal{{$factura->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteFacturaModalLabel{{$factura->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFacturaModalLabel{{$factura->id}}">Eliminar Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la factura:  "{{ $factura->numero }}"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
