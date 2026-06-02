<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\File;

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

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'precio_compra' => 'required|numeric|min:0',
            'descripcion'   => 'nullable|string',
            'stockmaximo'   => 'required|integer|min:0',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

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

    public function update(Request $request, Producto $producto)
    {
        try {
            if ($request->has('nombre')) {
                $producto->nombre = $request->nombre;
            }
            if ($request->has('precio_compra')) {
                $producto->preciocompra = $request->precio_compra;
            }
            if ($request->has('descripcion')) {
                $producto->descripcion = $request->descripcion;
            }
            if ($request->has('stockmaximo')) {
                $producto->stockmaximo = $request->stockmaximo;
                $producto->stock = $request->stockmaximo; // Actualiza stock también
            }

            // Manejo de imagen
            if ($request->hasFile('imagen')) {
                // Eliminar imagen anterior si no es la por defecto
                if ($producto->imagen && $producto->imagen !== 'sin-imagen.png') {
                    $rutaAnterior = public_path($producto->imagen);
                    if (File::exists($rutaAnterior)) {
                        File::delete($rutaAnterior);
                    }
                }
                $archivo = $request->file('imagen');
                $imagenNombre = time() . '_' . $archivo->getClientOriginalName();
                $archivo->move(public_path('imagen/productos'), $imagenNombre);
                $producto->imagen = 'imagen/productos/' . $imagenNombre;
            }

            $producto->save();

            return redirect()->route('productos.index')
                             ->with('success', 'Producto actualizado correctamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado.');
        }
        
        // Verificar si tiene detalles de compra asociados
        $totalDetalles = \DB::table('detallescompras')->where('producto_id', $id)->count();
        
        if ($totalDetalles > 0) {
            return redirect()->route('productos.index')
                            ->with('error', "El producto tiene $totalDetalles detalles de compra asociados. No se puede eliminar.");
        }
        
        // Eliminar imagen si no es la por defecto
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