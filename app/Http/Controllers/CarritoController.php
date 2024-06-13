<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Programar la funcion add del carrito
use App\Models\Producto;
use App\Models\Pedido;
use Session;

class CarritoController extends Controller
{
    //Funcion para crear la variable de sesion: permitira guardar todos los ids de los
    //productos agregados

    public function __construct(){
        if(!Session::has('carrito'))
        Session::put('carrito', array());
    }

    //Funcion para mostrar la vista del carrito de compras
    public function show(){
        $carrito = Session::get('carrito');
        //return $carrito;
        $total =$this->total();

        //Ahora se redireccionara a la vista carrito
        return view('carrito', compact('carrito', 'total'));
    }

    //Funcion para agregar items al carrito de compras
    public function add($id){
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);

        //Agregamos por defecto 1 a cada producto agregado al carrito
        $producto->cantidad = 1;

        $carrito[$producto->id] = $producto;
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function delete($id)
    {
        $carrito = Session::get('carrito');
        unset($carrito[$id]);
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function trash()
    {
        Session::forget('carrito');
        return redirect()->route('carrito');
    }

    
    public function update($id, $cantidad)
    {
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);
        $carrito[$producto->id]->cantidad = $cantidad;

        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function total(){
        $carrito = Session::get('carrito');
        $total = 0;

        foreach ($carrito as $item) {
            $total +=$item->precio*$item->cantidad;
        }
        return $total;
    } 

   public function guardarPedido()
   {
    $carrito = Session::get('carrito');
    {
        if(count($carrito));
        {
            $now = new \DateTime();
            $numero = $now->format('Ymd-His');
            foreach ($carrito as $producto)
            {
                $this->guardarItem($producto, $numero);
            }
        }
        Session::forget('carrito');
        return redirect()->route('productos.index');
    }
   } 

   protected function guardarItem($producto, $numero)
   {
    $productoguardado = Pedido::create
    ([
        'numero' => $numero,
        'idproducto' => $producto->id,
        'cantidad' => $producto->cantidad,
        'precio' => $producto->precio
    ]);
   }
}