<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodopago;

class MetodopagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $metodopagos = Metodopago::orderBy('nombre')->paginate(10);
        return view('metodopagos.index', compact('metodopagos'));
    }

    public function create()
    {
        return view('metodopagos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255|unique:metodopagos,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Metodopago::create([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'estado'       => 1,
            'registradopor'=> auth()->user()->name,
        ]);

        return redirect()->route('metodopagos.index')
                         ->with('success', 'Método de pago registrado correctamente.');
    }

    public function show(Metodopago $metodopago)
    {
        return view('metodopagos.show', compact('metodopago'));
    }

    public function edit(Metodopago $metodopago)
    {
        return view('metodopagos.edit', compact('metodopago'));
    }

    public function update(Request $request, Metodopago $metodopago)
    {
        try {
            if ($request->has('nombre')) {
                // Validar que el nombre no exista en otro registro
                $existing = Metodopago::where('nombre', $request->nombre)
                                     ->where('id', '!=', $metodopago->id)
                                     ->first();
                if ($existing) {
                    return back()->with('error', 'Este nombre de método de pago ya está registrado.');
                }
                $metodopago->nombre = $request->nombre;
            }
            if ($request->has('descripcion')) {
                $metodopago->descripcion = $request->descripcion;
            }

            $metodopago->save();

            return redirect()->route('metodopagos.index')
                             ->with('success', 'Método de pago actualizado correctamente.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el método de pago: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $metodopago = Metodopago::find($id);
        
        if (!$metodopago) {
            return redirect()->route('metodopagos.index')->with('error', 'Método de pago no encontrado.');
        }
        
        $totalPagos = \DB::table('pagos')->where('metodopago_id', $id)->count();
        
        if ($totalPagos > 0) {
            return redirect()->route('metodopagos.index')
                            ->with('error', "El método de pago tiene $totalPagos pagos asociados. No se puede eliminar.");
        }
        
        $metodopago->delete();
        return redirect()->route('metodopagos.index')
                        ->with('success', 'Método de pago eliminado correctamente.');
    }

    public function cambioestado(Request $request)
    {
        $metodopago = Metodopago::find($request->id);
        $metodopago->estado = $request->estado;
        $metodopago->save();

        return response()->json(['success' => true]);
    }
}