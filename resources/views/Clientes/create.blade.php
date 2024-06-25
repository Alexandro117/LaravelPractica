@extends('master')
@section('titulo','Crear un Cliente')

@section('contenido')
    <div class="container text-center">
        <h1>Crear cliente</h1>
        <br>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open(['route' => 'clientes.store', 'id' => 'cliente-form']) !!}
            <div class="form-group">
                <!-- Aquí van tus campos del formulario -->
            </div>
            <br>
            {!! Form::submit('Guardar cliente', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
        <hr>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Espera a que el documento esté listo
        document.addEventListener("DOMContentLoaded", function() {
            // Agrega un evento al formulario para detectar el envío
            document.getElementById('cliente-form').addEventListener('submit', function(event) {
                // Abre el modal cuando se envía el formulario
                $('#exampleModal').modal('show');
                // Detiene el envío del formulario
                event.preventDefault();
            });
        });
    </script>
@endsection

