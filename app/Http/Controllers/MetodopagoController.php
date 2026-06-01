<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetodopagoRequest; // 👈 Importa el Request
use App\Models\Metodopago;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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

    public function store(MetodopagoRequest $request) // 👈 Usa MetodopagoRequest
    {
        Metodopago::create([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'estado'       => $request->estado,
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

    public function update(MetodopagoRequest $request, Metodopago $metodopago) 
    {
        $metodopago->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('metodopagos.index')
                         ->with('success', 'Método de pago actualizado correctamente.');
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