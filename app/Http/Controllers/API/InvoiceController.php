<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\LineItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use PDF;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'from' => [
                    'required',
                    Rule::exists('users', 'id')
                ],
                'to' => [
                    'required', Rule::exists('users', 'id')
                ],
                'invoice_no' => [
                    'required', 'string', Rule::unique('invoices', 'invoice_no')
                ],
                'due_date' => [
                    'required','after:start_time'
                ],
                "line_items" => [
                    "nullable", "array"
                ],
                'line_items.*.item' => [
                    'required',
                ],
                'line_items.*.quantity' => [
                    'required', 'numeric'
                ],
                'line_items.*.rate' => [
                    'required', 'numeric'
                ],
                'line_items.*.tax' => [
                    'required', 'numeric'
                ],
                'line_items.*.sub_total' => [
                    'required', 'numeric'
                ],
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            \DB::beginTransaction();
            $invoice = new Invoice();
            $invoice->fill($request->all());
            $invoice->save();

            foreach ($request->input('line_items') as $lineItemData) {
                $lineItem = new LineItem();
                $lineItem->invoice_id = $invoice->id;
                $lineItem->fill($lineItemData);
                $lineItem->save();
            }
            \DB::commit();
            return response()->json(['message' => 'Invoice generated successfully'], 201);
        } catch (\Throwable $th) {
            \DB::rollback();
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function generateInvoice($id){
        $invoice = Invoice::with('lineItems', 'fromUser', 'toUser')->find($id);
        $pdf = PDF::loadView('invoice', compact('invoice'));

        return $pdf->stream('invoice.pdf');
    }

    public function index(){
        $invoices = Invoice::with('lineItems', 'fromUser', 'toUser')->get();
        return view('invoice-list',[
            'invoices' => $invoices
        ]);
    }

}
