@extends('master')
@section('contenido')
<div class="container">

    <p>Listado de Perfiles</p>
        <!-- Button Crear perfil modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPerfilModal">
            Crear Nuevo Perfil
        </button>
        <!--FORMULARIO DE BUSQUEDA  -->
        {!! Form::open(['route'=>'perfiles.index','method'=>'GET','class'=>'navbar-form'])
            !!}
            <div class="form-group">
                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre',
                    'placeholder'=>'Buscar Perfil']) !!}
                    {!!Form::submit('Buscar Perfil',array('class'=>'btn btn-primary'))!!}
            </div>
            {!!Form::close() !!}
            
    <p></p>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Actualizar</th>
                    <th scope="col" class="text-start">Eliminar</th>
                    <th scope="col" class="text-start">Id</th>
                    <th scope="col" class="text-start">Nombre</th>
                </tr>
            </thead>
                @foreach($perfiles as $perfil)
                <tr>
                    <td class="text-center">
                        <!--Boton Actualizar perfil -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updatePerfilModal{{$perfil->id}}">
                            <i class="bi bi-repeat"></i>
                        </button>
                    </td>
                    <td class="text-start">
                        {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                        <!-- Boton eliminar perfil -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePerfilModal{{$perfil->id}}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                        {!! Form::close() !!}
                    </td>
                    <td class="text-start">{{ $perfil->id }}</td>
                    <td class="text-start">{{ $perfil->nombre }}</td>
                </tr>
                      <!-- Modal Update -->
                <div class="modal fade" id="updatePerfilModal{{$perfil->id}}" tabindex="-1" role="dialog" aria-labelledby="updatePerfilModalLabel{{$perfil->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updatePerfilModalLabel{{$perfil->id}}">Actualizar Perfil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::model($perfil, ['route' => ['perfiles.update', $perfil->id], 'method' => 'PUT']) !!}
                                <div class="form-group">
                                    {!! Form::text('nombre', $perfil->nombre, array(
                                        'class'=>'form-control',
                                        'required'=>'required',
                                        'placeholder'=>'Nombre del perfil...'
                                    )) !!}
                                </div>
                                {!! Form::submit('Actualizar Perfil', array('class'=>'btn btn-success')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
        </table>
        {{ $perfiles->links()}}
        <hr>
        <!-- Modal Insert-->
<!-- Modal Create Cliente -->
<div class="modal fade" id="createPerfilModal" tabindex="-1" role="dialog" aria-labelledby="createPerfilModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPerfilModalLabel">Crear Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'perfiles.store']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', null, array(
                        'class'=>'form-control',
                        'required'=>'required',
                        'placeholder'=>'Nombre del perfil...'
                        )) !!}
                    </div>
                    {!! Form::submit('Guardar Perfil', array('class'=>'btn btn-success'))!!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
@foreach($perfiles as $perfil)
<div class="modal fade" id="deletePerfilModal{{$perfil->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePerfilModalLabel{{$perfil->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePerfilModalLabel{{$perfil->id}}">Eliminar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el perfil "{{ $perfil->nombre }}"?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endforeach             
@endsection