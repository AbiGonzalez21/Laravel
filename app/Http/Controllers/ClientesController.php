<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClientesController extends Controller
{
    //listar todos los clientes 
    public function index(Request $request)
    {
     
    //$perfiles = DB::table('perfiles')->get();
    $clientes = Cliente::Buscador($request->nombre)->orderBy('id','asc')->paginate(2); // Cambiado de $Clientes a $clientes
    return view('clientes.index', compact('clientes')); 
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
        $this->validate($request,[
            'nombre'=>'required|unique:clientes',
            'rfc' => 'required|unique:clientes',
            //'direccion' => 'required|unique:clientes',
            'telefono' => 'required|unique:clientes',
            'email' => 'required|unique:clientes'
        ]);

        $Cliente = Cliente::create([
                'nombre'=>$request->get('nombre'),
                'rfc' => $request->get('rfc'),
                'direccion' => $request->get('direccion'),
                'telefono' => $request->get('telefono'),
                'email' => $request->get('email')
        ]);

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
        return view('clientes.editar', compact ('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'nombre'=>'required|unique:clientes',
            'rfc' => 'required:clientes',
            'direccion' => 'required:clientes',
            'telefono' => 'required:clientes',
            'email' => 'required:clientes'

        ]);

        $Cliente = Cliente::find($id);
        $Cliente->nombre = $request->get("nombre");
        $Cliente->rfc = $request->get("rfc");
        $Cliente->direccion = $request->get("direccion");
        $Cliente->telefono = $request->get("telefono");
        $Cliente->email = $request->get("email");

        $Cliente->save();

        return redirect()->route('clientes.index');
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Cliente = Cliente::find($id);
        $Cliente->delete();

        return redirect()->route('clientes.index');
    }

}