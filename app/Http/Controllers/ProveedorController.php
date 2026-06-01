<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorRequest; // 👈 Importa el Request
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

    public function store(ProveedorRequest $request) // 👈 Usa ProveedorRequest
    {
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

    public function update(ProveedorRequest $request, Proveedor $proveedor) // 👈 Usa ProveedorRequest
    {
        $proveedor->update([
            'nombre'    => $request->nombre,
            'documento' => $request->documento,
            'direccion' => $request->direccion,
            'telefono'  => $request->telefono,
            'email'     => $request->email,
            'estado'    => $request->estado,
        ]);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor actualizado correctamente.');
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