<?php

namespace App\Http\Controllers;

use App\Mail\facturaCreada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*Modelo que usa Facturas*/
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\EstadoFactura;


class FacturasController extends Controller
{

   // public function __construct(){
     //   $this->middleware('auth');
    //}
   // public function __construct(){
     //   $this->middleware('auth',['except' =>'index']);
    //}

    public function __construct(){
        $this->middleware('auth');
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

    $facturas = Factura::Buscador($request->numero)->orderBy('numero', 'asc' )->paginate(2);

    //$facturas = Factura::all();

    return view('facturas.index', compact('clientes', 'estadosfacturas','formaspago','facturas'));
    
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
/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $this->validate($request, [
        'numero' => 'required',
        'detalles' => 'required',
        'valor' => 'required',
        'archivo' => 'required',
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
    return redirect()->route('facturas.index')->with('mensaje', $mensaje);
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
        return view('clientes.editar', compact ('cliente'));
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
            'archivo' => 'mimes:jpeg,png',
            'idcliente' => 'required',
            'idforma' => 'required',
            'idestado' => 'required'
        ]);
        
         //Cambia el nombre y guarda el archivo
        $now = new \DateTime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $nombre = "";


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