<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Ordencompra;
use App\Models\Metodopago;

class PagoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pagos = Pago::with('ordencompra', 'metodopago')
                     ->orderBy('fechapago', 'desc')
                     ->paginate(10);

        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $ordencompras = Ordencompra::where('estado', '1')
                                   ->orderBy('id', 'desc')
                                   ->get();

        $metodopagos  = Metodopago::where('estado', '1')
                                   ->orderBy('nombre')
                                   ->get();

        return view('pagos.create', compact('ordencompras', 'metodopagos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ordencompra_id' => 'required|exists:ordencompras,id',
            'metodopago_id'  => 'required|exists:metodopagos,id',
            'fechapago'      => 'required|date',
            'monto'          => 'required|numeric|min:0',
        ]);

        Pago::create([
            'ordencompra_id' => $request->ordencompra_id,
            'metodopago_id'  => $request->metodopago_id,
            'fechapago'      => $request->fechapago,
            'monto'          => $request->monto,
            'registradopor'  => auth()->user()->name,
        ]);

        return redirect()->route('pagos.index')
                         ->with('success', 'Pago registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load('ordencompra', 'metodopago');
        return view('pagos.show', compact('pago'));
    }

    public function edit(Pago $pago)
    {
        $ordencompras = Ordencompra::orderBy('id', 'desc')->get();
        $metodopagos  = Metodopago::where('estado', '1')
                                   ->orderBy('nombre')
                                   ->get();

        return view('pagos.edit', compact('pago', 'ordencompras', 'metodopagos'));
    }

    public function update(Request $request, Pago $pago)
    {
        // Validación
        $request->validate([
            'ordencompra_id' => 'required|exists:ordencompras,id',
            'metodopago_id'  => 'required|exists:metodopagos,id',
            'fechapago'      => 'required|date',
            'monto'          => 'required|numeric|min:0',
        ]);

        // Actualización directa y segura
        $pago->update([
            'ordencompra_id' => $request->ordencompra_id,
            'metodopago_id'  => $request->metodopago_id,
            'fechapago'      => $request->fechapago,
            'monto'          => $request->monto,
        ]);

        // Redirección forzada al índice
        return redirect()->route('pagos.index')
                         ->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy($id)
    {
        $pago = Pago::find($id);
        
        if (!$pago) {
            return redirect()->route('pagos.index')->with('error', 'Pago no encontrado.');
        }
        
        $pago->delete();
        return redirect()->route('pagos.index')
                        ->with('success', 'Pago eliminado correctamente.');
    }
}