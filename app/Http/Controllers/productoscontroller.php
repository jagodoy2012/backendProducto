<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos;
use Illuminate\Support\Facades\DB;
class productoscontroller extends Controller
{
    public function getProductosAll(){
       $productos = productos::select('id', 'referencia', 'descrip', 'stock', 'REF')->get();
    return response()->json($productos, 200);
 
    }

    public function getProductos(){
        $productos = productos::select('productos.id', 'productos.REF', 'productos.stock', 'productos.descrip as producto', 'productos.referencia', DB::raw('COALESCE(SUM(e2.suma_stock_subordinados), 0) AS total'))
        ->leftJoin(DB::raw('(SELECT referencia, REF, SUM(stock) AS suma_stock_subordinados FROM productos GROUP BY referencia, REF) AS e2'), 'e2.REF', 'LIKE', DB::raw('CONCAT("%", productos.id, "%")'))
        ->groupBy('productos.id', 'productos.REF', 'productos.stock', 'productos.descrip', 'productos.referencia')
        ->orderBy('REF', 'ASC')
        ->limit(25)
        ->get();

    return response()->json($productos, 200);

    }

    public function postProductos(Request $request){

        $productos = productos::create($request->all());
        return response($productos,200);
    }


    public function putProductos(Request $request,$id){
            $producto = productos::find($id);
            if(is_null($producto)){
                return response()->json(['Mensaje'=>'Registro no encontrado'],400);
            }
            $producto->update($request->all());
            return response($producto,200);
    }

    public function delProductos(Request $request,$id){
        $producto = productos::find($id);
        if(is_null($producto)){
            return response()->json(['Mensaje'=>'Registro no encontrado'],400);
        }
        $producto->delete($request->all());
        return response($producto,200);
}

}
 