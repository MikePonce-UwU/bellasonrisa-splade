<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Tables\Invoices;

class InvoiceController extends Controller
{
    private $invoices;
    public function __construct()
    {
        $this->invoices = Invoices::class;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.invoices.index', ['invoices' => $this->invoices]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
        $invoice = Invoice::create([
            'numero_factura' => str($request->input('numero_factura'))->lower(),
            'razon' => str($request->input('razon'))->lower(),
            'descripcion_factura' => str($request->input('descripcion_factura'))->lower(),
            'total_factura' => $request->input('total_factura'),
            'income' => $request->input('income'),
        ]);
        $invoice->iva = $request->input('total_factura') > 0 ? $request->input('total_factura') - ($request->input('total_factura') / 1.15) : 0;
        $invoice->save();
        return redirect()->route('invoices.index')->with('flash.banner', '[' . $invoice->created_at . '] La factura fue creada: ' . str($invoice->numero_factura)->upper())->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
        return view('pages.invoices.show', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Invoice $invoice)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
        $invoice->numero_factura = str($request->input('numero_factura'))->lower();
        $invoice->razon = str($request->input('razon'))->lower();
        $invoice->descripcion_factura = str($request->input('descripcion_factura'))->lower();
        $invoice->total_factura = $request->input('total_factura');
        $invoice->income = $request->input('income');
        $invoice->iva = $request->input('total_factura') > 0 ? $request->input('total_factura') - ($request->input('total_factura') / 1.15) : 0;
        $invoice->save();
        return redirect()->route('invoices.index')->with('flash.banner', '[' . $invoice->updated_at . '] La factura fue modificada: ' . str($invoice->numero_factura)->upper())->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
        $invoice->delete();
        return redirect()->route('invoices.index')->with('flash.banner', '[' . $invoice->deleted_at . '] La factura fue eliminada: ' . str($invoice->numero_factura)->upper())->with('flash.bannerStyle', 'danger');
    }
}
