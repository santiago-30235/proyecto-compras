<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdencompraRequest; // 👈 Importa el Request
use App\Models\Ordencompra;
use App\Models\Proveedor;
use App\Models\Metodopago;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class OrdencompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ordencompras = Ordencompra::with('proveedor')
                                   ->orderBy('fecha', 'desc')
                                   ->paginate(10);

        return view('ordencompras.index', compact('ordencompras'));
    }

    public function create()
    {
        $proveedores = Proveedor::where('estado', '1')
                                ->orderBy('nombre')
                                ->get();

        $metodospago = Metodopago::where('estado', '1')
                                 ->orderBy('nombre')
                                 ->get();

        return view('ordencompras.create', compact('proveedores', 'metodospago'));
    }

    public function store(OrdencompraRequest $request) // 👈 Usa OrdencompraRequest
    {
        Ordencompra::create([
            'proveedor_id'   => $request->proveedor_id,
            'fecha'          => $request->fecha,
            'total'          => $request->total,
            'tipopago'       => $request->tipopago,
            'saldopendiente' => $request->saldopendiente ?? 0,
            'estado'         => $request->estado,
            'registradopor'  => auth()->user()->name,
        ]);

        return redirect()->route('ordencompras.index')
                         ->with('success', 'Orden de compra registrada correctamente.');
    }

    public function show(Ordencompra $ordencompra)
    {
        $ordencompra->load('proveedor', 'detallecompras', 'pagos');

        return view('ordencompras.show', compact('ordencompra'));
    }

    public function edit(Ordencompra $ordencompra)
    {
        $proveedores = Proveedor::where('estado', '1')
                                ->orderBy('nombre')
                                ->get();

        $metodospago = Metodopago::where('estado', '1')
                                 ->orderBy('nombre')
                                 ->get();

        return view('ordencompras.edit', compact('ordencompra', 'proveedores', 'metodospago'));
    }

    public function update(OrdencompraRequest $request, Ordencompra $ordencompra) // 👈 Usa OrdencompraRequest
    {
        $ordencompra->update([
            'proveedor_id'   => $request->proveedor_id,
            'fecha'          => $request->fecha,
            'total'          => $request->total,
            'tipopago'       => $request->tipopago,
            'saldopendiente' => $request->saldopendiente ?? 0,
            'estado'         => $request->estado,
        ]);

        return redirect()->route('ordencompras.index')
                         ->with('success', 'Orden de compra actualizada correctamente.');
    }

    public function destroy($id)
    {
        $ordencompra = Ordencompra::find($id);
        
        if (!$ordencompra) {
            return redirect()->route('ordencompras.index')->with('error', 'Orden de compra no encontrada.');
        }
        
        $totalPagos = \DB::table('pagos')->where('ordencompra_id', $id)->count();
        
        if ($totalPagos > 0) {
            return redirect()->route('ordencompras.index')
                            ->with('error', "La orden de compra tiene $totalPagos pagos asociados. No se puede eliminar.");
        }
        
        $ordencompra->delete();
        return redirect()->route('ordencompras.index')
                        ->with('success', 'Orden de compra eliminada correctamente.');
    }

    public function cambioestado(Request $request)
    {
        $ordencompra = Ordencompra::find($request->id);
        $ordencompra->estado = $request->estado;
        $ordencompra->save();

        return response()->json(['success' => true]);
    }
}