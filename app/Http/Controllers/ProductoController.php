<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest; // 👈 Importa el Request
use App\Models\Producto;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::orderBy('nombre')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(ProductoRequest $request) // 👈 Usa ProductoRequest
    {
        $imagenNombre = 'sin-imagen.png';
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $imagenNombre = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('imagen/productos'), $imagenNombre);
        }

        Producto::create([
            'nombre'        => $request->nombre,
            'preciocompra'  => $request->precio_compra,
            'descripcion'   => $request->descripcion,
            'stockmaximo'   => $request->stockmaximo,
            'stock'         => $request->stockmaximo,
            'imagen'        => 'imagen/productos/' . $imagenNombre,
            'estado'        => 1,
            'registradopor' => auth()->user()->name,
        ]);

        return redirect()->route('productos.index')
                         ->with('success', 'Producto registrado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(ProductoRequest $request, Producto $producto) // 👈 Usa ProductoRequest
    {
        $imagenNombre = $producto->imagen;
        if ($request->hasFile('imagen')) {
            if ($imagenNombre !== 'sin-imagen.png') {
                $rutaAnterior = public_path('imagen/productos/' . $imagenNombre);
                if (File::exists($rutaAnterior)) {
                    File::delete($rutaAnterior);
                }
            }
            $archivo = $request->file('imagen');
            $imagenNombre = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('imagen/productos'), $imagenNombre);
        }

        $producto->update([
            'nombre'        => $request->nombre,
            'preciocompra'  => $request->precio_compra,
            'descripcion'   => $request->descripcion,
            'stockmaximo'   => $request->stockmaximo,
            'stock'         => $request->stockmaximo,
            'imagen'        => 'imagen/productos/' . $imagenNombre,
        ]);

        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }
        
        $totalDetalles = \DB::table('detallescompras')->where('producto_id', $id)->count();
        
        if ($totalDetalles > 0) {
            return redirect()->route('productos.index')
                            ->with('error', "El producto tiene $totalDetalles detalles de compra asociados. No se puede eliminar.");
        }
        
        if ($producto->imagen && $producto->imagen !== 'sin-imagen.png') {
            $ruta = public_path($producto->imagen);
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }
        
        $producto->delete();
        return redirect()->route('productos.index')
                        ->with('success', 'Producto eliminado correctamente.');
    }

    public function cambioestado(Request $request)
    {
        $producto = Producto::find($request->id);
        $producto->estado = $request->estado;
        $producto->save();

        return response()->json(['success' => true, 'mensaje' => 'Estado actualizado']);
    }
}