@extends('master')

@section('titulo', 'Listado de Clientes')

@section('contenido')
<div class="container text-center">
    <h1>Listado de Clientes</h1>
    <br>
    <hr>
<br>
{!!Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-form'])
!!}
<div class="form-group">
    {!!Form::text('nombre',null,['class'=>'form-control', 'id'=>'nombre','
        placeholder'=>'Buscar Cliente'])!!}
        <br>
    {!!Form::submit('Buscar Cliente',array('class'=>'btn btn-primary'))!!}
    </div>
    <br>
{!!Form::close()!!}
<a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#crearClienteModal">Crear Nuevo Cliente</a>
<br>
    <!-- Modal -->
    <div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear un nuevo cliente -->
                    {!! Form::open(['route' => 'clientes.store']) !!}
                        <div class="form-group">
                           
                            {!! Form::text('nombre', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Nombre del cliente...']) !!}
                        </div>
                        <div class="form-group">
                          
                            {!! Form::text('rfc', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'RFC del cliente...']) !!}
                        </div>
                        <div class="form-group">
                            
                            {!! Form::text('direccion', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Dirección del cliente...']) !!}
                        </div>
                        <div class="form-group">
                          
                            {!! Form::text('telefono', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Teléfono del cliente...']) !!}
                        </div>
                        <div class="form-group">
                           
                            {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Correo Electrónico del cliente...']) !!}
                        </div>
                </div>
                <div class="modal-footer">
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <!-- Botón para enviar el formulario -->
                    {!! Form::submit('Guardar cliente', ['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
<br>
<table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Numero</th>
                <th scope="col">Nombre</th>
                <th scope="col">RFC</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>

                <a class="btn btn-warning" href="{{ route('clientes.edit', $cliente->id) }}">
            <i class="bi bi-pencil-square"></i>
        </a>

                    
                </td>
                <td>
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar cliente?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    {!! Form::close() !!}
                </td>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->rfc }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->telefono}}</td>
                <td>{{ $cliente->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    
   

     <!-- Botón para abrir el modal -->
     <br>
    <br>
    {{ $clientes->links() }}
<hr>
   </div>
@endsection


