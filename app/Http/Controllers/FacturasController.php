<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Factura;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\EstadoFactura;
use App\Mail\FacturaCreada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class FacturasController extends Controller
{
    public function __construct(){
        $this->middleware('admin',['except'=>'index']);
    }
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $estadosfacturas = EstadoFactura::orderBy('nombre','asc') ->pluck('nombre','id');
    $clientes = Cliente::orderBy('nombre','asc') ->pluck('nombre','id');
    $formaspago = FormaPago::orderBy('nombre','asc') ->pluck('nombre','id');

    $facturas = Factura::Buscador($request->numero)->orderBy('numero', 'asc' )->simplepaginate(2);

    //$facturas = Factura::all();

    return view('facturas.index', compact('clientes', 'estadosfacturas','formaspago','facturas'));
    
    }
    public function pdf  (){
        
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$clientes=Cliente::all();
        //$facturas=Factura::all();
        //$estadosfacturas=EstadoFactura::all();
        return view ('perfiles.index');
    }
    public function edit($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            // Añade un manejo de error si la factura no existe
            return redirect()->back()->withErrors('Factura no encontrada.');
        }
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        
        // Asegúrate de pasar 'detalles' si es un atributo de factura, como $factura->detalles
        $detalles = $factura->detalles ?? ''; // Usa el operador de fusión de null para manejar casos donde no haya detalles.
    
        return view('facturas.editar', compact('factura', 'clientes', 'formas', 'estados', 'detalles'));
    }
/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $this->validate($request, [
        'numero' => 'required',
        'detalles' => 'required',
        'valor' => 'required',
        
        'idcliente' => 'required',
        'idforma' => 'required',
        'idestado' => 'required' 
    ]);


     //Cambia el nombre y guarda el archivo
     $now = new \DateTime();
     $fecha = $now->format('Ymd-His');
     $numero = $request->get('numero');
     $archivo = $request->file('archivo');
     $nombre = " ";


     if($archivo){
         $extension = $archivo->getClientOriginalExtension();
         $nombre = "factura-".$numero."-".$fecha.".".$extension;
         \Storage::disk('local')->put($nombre, \File::get($archivo));
     }

    $factura = Factura::create([
        'numero' => $request->get('numero'),
        'detalles' => $request->get('detalles'),
        'valor' => $request->get('valor'),
        'archivo' => $nombre,
        'idcliente' => $request->get('idcliente'),
        'idforma' => $request->get('idforma'),
        'idestado' => $request->get('idestado'),

        



    ]);

        //Generar Mail de notificación
        $numerofactura = $request->get('numero');
        $valorfactura = $request->get('valor');

        //Obtener el email del usuario que se encuentra logueado
        $emailto = Auth::user()->email;
        Mail::to($emailto)->send(new FacturaCreada($numerofactura, $valorfactura));
        
        $mensaje = $factura?'Factura creada con exito':'La factura no pudo crearse';

        return redirect()->route('facturas.index')->with('mensaje',$mensaje);
    
}

    
     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'numero' => 'required',
            'detalles' => 'required',
            'valor' => 'required',
           
            'idcliente' => 'required',
            'idforma' => 'required',
            'idestado' => 'required'
        ]);
        
         //Cambia el nombre y guarda el archivo
        $now = new \DateTime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $nombre = " ";


        if($archivo){
            $extension = $archivo->getClientOriginalExtension();
            $nombre = "factura-".$numero."-".$fecha.".".$extension;
            \Storage::disk('local')->put($nombre, \File::get($archivo));
        }

        $factura = factura::find($id);
        $factura->numero = $request->get("numero");
        $factura->detalles = $request->get("detalles");
        $factura->valor = $request->get("valor");
        if($archivo){
            $factura->archivo = $nombre;
        }
        $factura->idcliente = $request->get("idcliente");
        $factura->idforma = $request->get("idforma");
        $factura->idestado = $request->get("idestado");

        $factura->save();

        return redirect()->route('facturas.index');
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factura = factura::find($id);
        $factura->delete();

        return redirect()->route('facturas.index');
    }

}