<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPago;

class FormasPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formaspago = FormaPago::all();
        return view('formaspago.index', ['formaspago' => $formaspago]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formaspago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:formaspago'
        ]);

        $formapago = FormaPago::create([
            'nombre' => $request->get('nombre')
        ]);

        return redirect()->route('formaspago.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $formapago = FormaPago::find($id);
        return view('formaspago.edit', compact('formapago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required|unique:formaspago,nombre,' . $id
        ]);

        $formapago = FormaPago::find($id);
        $formapago->nombre = $request->get('nombre');
        $formapago->save();

        return redirect()->route('formaspago.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formapago = FormaPago::find($id);
        $formapago->delete();

        return redirect()->route('formaspago.index');
    }
}
