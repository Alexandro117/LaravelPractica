<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
 



        //$perfiles = DB::table('perfiles')->get();
        $clientes = Cliente::Buscador($request->nombre)->orderBy('id', 'asc')->simplepaginate(2);
        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos ingresados
        $this->validate($request, [
            'nombre' => 'required|unique:clientes,nombre', // Asegura que el nombre sea único en la tabla clientes
            'rfc' => 'required|unique:clientes,rfc',       // Asegura que el RFC sea único en la tabla clientes
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:clientes,email', // Verifica que el email sea único y esté en formato correcto
        ]);
    
        // Creación del cliente con los datos proporcionados
        $cliente = Cliente::create([
            'nombre' => $request->input('nombre'),
            'rfc' => $request->input('rfc'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
        ]);
    
        // Redireccionamiento a la página de índice de clientes después de crear exitosamente
        return redirect()->route('clientes.index');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = cliente::find($id);
        return view('clientes.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos ingresados en el formulario
        $this->validate($request, [
            'nombre' => 'required|unique:clientes,nombre,' . $id,
            'rfc' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email'
        ]);
    
        // Buscar el cliente a actualizar
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->route('clientes.index')->withErrors('Cliente no encontrado.');
        }
    
        // Actualizar los datos del cliente
        $cliente->nombre = $request->nombre;
        $cliente->rfc = $request->rfc;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
    
        // Redirigir al usuario a la lista de clientes con un mensaje
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }

    
}
