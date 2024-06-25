@extends('master')

@section('titulo', 'Listado de Facturas')

@section('contenido')
<div class="container text-center">
    <h1>Listado de Facturas</h1>
    <hr>

{!!Form::open(['route'=>'facturas.index','method'=>'GET','class'=>'navbar-form'])
!!}
<div class="form-group">
    {!!Form::text('numero',null,['class'=>'form-control', 'id'=>'numero','
        placeholder'=>'Buscar Numero Cliente'])!!}
        <br>
    {!!Form::submit('Buscar Numero Factura',array('class'=>'btn btn-primary'))!!}
    </div>
{!!Form::close()!!}  
<br>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#createFacturaModal">
                    Crear Nueva Factura
        </button>
        <br>
        <br>
        <table class="table table-success table-striped">
        <thead>

            <tr>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Número</th>
                <th >Cliente</th>
                <th>RFC</th>
                <th>Valor</th>
                <th>Archivo</th>
                <th>Detalles </th>
            </tr>
           
        </thead>
        
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>
                    <a class="btn btn-warning" href="{{ route('facturas.edit', $factura->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar factura?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    {!! Form::close() !!}
                </td>
                <td>{{ $factura->numero }}</td>

                <td>{{ $factura->cliente->nombre}}</td>
                <td>{{ $factura->cliente->rfc}}</td>

                <td>${{number_format($factura->valor)}}</td>
                <td><img src="{{asset('archivos/'.$factura->archivo.'')}}" width="150"></td>
                <td>{!! $factura->detalles !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <br>
        <!--Boton insertar Facturas Modal -->
       
    <!--<a class="btn btn-success" href="{{route('facturas.create')}}">Crear Nueva factura</a>
    -->
    <br>
    <br>
    {{ $facturas->links() }}

  
</div>
<!--Modal Insertar -->
<div class="modal fade" id="createFacturaModal" tabindex="-1" role="dialog" aria-labelledby="createFacturaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFacturaModalLabel">Crear Factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'facturas.store','method' => 'POST', 'files' => true]) !!}
                    <div class="form-group">
                        {!! Form::text('numero', null, array(
                        'class'=>'form-control rounded-pill',
                        'required'=>'required',
                        'placeholder'=>'Numero factura...'
                        )) !!}
                    </div>
                <br>
                <label>Detalles</label>
                <textarea name="detalles" id="editor1" cols="30" rows="10" required></textarea>
                 <script>
                        CKEDITOR.replace( 'editor1' );
                 </script>
                <br>
                    <div class="form-group">
                        {!! Form::text('valor', null, array(
                        'class'=>'form-control rounded-pill',
                        'required'=>'required',
                        'placeholder'=>'Valor Factura...'
                        )) !!}
                    </div>
                    <br>
                    <div class="form-gruop">
                        {!! Form::select('idcliente', $clientes  , null,['class' => 'form-control rounded-pill']) !!}
                    </div>
                    <br>
                    <div class="form-gruop">
                        {!! Form::select('idforma', $formaspago, null,['class' => 'form-control rounded-pill']) !!}
                    </div><br>
                    <div class="form-gruop">
                        {!! Form::select('idestado', $estadosfacturas, null,['class' => 'form-control rounded-pill']) !!}
                    </div><br>
                    <div class="form-gruop">
                       {!! Form::file('archivo',['class' => 'form-control rounded-pill']); !!}
                    </div>
                    <br>
                    {!! Form::submit('Guardar Factura', array('class'=>'btn btn-success rounded-pill'))!!}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        
    </div>
 
@endsection
