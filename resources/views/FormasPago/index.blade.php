@extends('master')
@section('contenido')
<div class="container">

    <p>Listado de formas de pago</p>
        <!-- Button Crear perfil modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createFormasPagoModal">
            Crear Nueva forma Pago
        </button>
    <p></p>
        <table class="table table-success table-striped"">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Actualizar</th>
                    <th scope="col" class="text-start">Eliminar</th>
                    <th scope="col" class="text-start">Id</th>
                    <th scope="col" class="text-start">Nombre</th>
                </tr>
            </thead>
                @foreach($formaspago as $formapago)
                <tr>
                    <td class="text-center">
                        <!--Boton Actualizar FormasPago -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateFormasPagoModal{{$formapago->id}}">
                            <i class="bi bi-repeat"></i>
                        </button>
                    </td>
                    <td class="text-start">
                        {!! Form::open(['route' => ['formaspago.destroy', $formapago->id], 'method' => 'DELETE']) !!}
                        <!-- Boton eliminar FormasPago -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFormasPagoModal{{$formapago->id}}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td class="text-start">{{ $formapago->id }}</td>
                    <td class="text-start">{{ $formapago->nombre }}</td>
                </tr>
                      <!-- Modal Update FormasPago -->
                <div class="modal fade" id="updateFormasPagoModal{{$formapago->id}}" tabindex="-1" role="dialog" aria-labelledby="updateFormasPagoModalLabel{{$formapago->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateFormasPagoModalLabel{{$formapago->id}}">Actualizar Forma Pago</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::model($formapago, ['route' => ['formaspago.update', $formapago->id], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    {!! Form::text('nombre', $formapago->nombre, array(
                                        'class'=>'form-control',
                                        'required'=>'required',
                                        'placeholder'=>'Nombre Forma Pago...'
                                    )) !!}
                                </div>
                                {!! Form::submit('Actualizar Forma Pago', array('class'=>'btn btn-success')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
        </table>

<!-- Modal Create Forma Pago -->
<div class="modal fade" id="createFormasPagoModal" tabindex="-1" role="dialog" aria-labelledby="createFormasPagoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormasPagoModalLabel">Crear Forma Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'formaspago.store']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Nombre Forma Pago...'
                        )) !!}
                    </div>
                    {!! Form::submit('Guardar Forma Pago', array('class'=>'btn btn-success'))!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
@foreach($formaspago as $formapago)
<div class="modal fade" id="deleteFormasPagoModal{{$formapago->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteFormasPagoModalLabel{{$formapago->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteFormasPagoModalLabel{{$formapago->id}}">Eliminar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar la forma de pago "{{ $formapago->nombre }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['route' => ['formaspago.destroy', $formapago->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach             
@endsection