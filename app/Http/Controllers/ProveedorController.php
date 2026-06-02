<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // 👈 Usamos Request normal
use App\Models\Proveedor;
use App\Models\Ordencompra;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'telefono'  => 'required|string|max:20',
            'email'     => 'required|email|unique:proveedores,email',
        ]);

        Proveedor::create([
            'nombre'        => $request->nombre,
            'documento'     => $request->documento,
            'direccion'     => $request->direccion,
            'telefono'      => $request->telefono,
            'email'         => $request->email,
            'estado'        => 1,
            'registradopor' => auth()->user()->name,
        ]);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor registrado correctamente.');
    }

    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        try {
            if ($request->has('nombre')) {
                $proveedor->nombre = $request->nombre;
            }
            if ($request->has('documento')) {
                $proveedor->documento = $request->documento;
            }
            if ($request->has('telefono')) {
                $proveedor->telefono = $request->telefono;
            }
            if ($request->has('email')) {
                $existing = Proveedor::where('email', $request->email)
                                     ->where('id', '!=', $proveedor->id)
                                     ->first();
                if ($existing) {
                    return back()->with('error', 'El email ya está registrado por otro proveedor.');
                }
                $proveedor->email = $request->email;
            }
            if ($request->has('direccion')) {
                $proveedor->direccion = $request->direccion;
            }

            $proveedor->save();

            return redirect()->route('proveedores.index')
                             ->with('success', 'Proveedor actualizado correctamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el proveedor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        
        if (!$proveedor) {
            return redirect()->route('proveedores.index')->with('error', 'Proveedor no encontrado.');
        }
        
        $totalOrdenes = Ordencompra::where('proveedor_id', $id)->count();
        
        if ($totalOrdenes > 0) {
            return redirect()->route('proveedores.index')->with('error', "El proveedor tiene $totalOrdenes órdenes de compra. No se puede eliminar.");
        }
        
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }

    public function cambioestado(Request $request)
    {
        $proveedor = Proveedor::find($request->id);
        $proveedor->estado = $request->estado;
        $proveedor->save();

        return response()->json(['success' => true, 'mensaje' => 'Estado actualizado']);
    }
}