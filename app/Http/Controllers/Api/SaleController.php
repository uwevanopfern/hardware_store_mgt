<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Requests\SalesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SalesCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Sales as SalesResource;

class SaleController extends Controller
{
    /**
     * Get auth user
     */
    private function getAuthUser()
    {
        return Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return SalesCollection
     */
    public function index()
    {
        $companyId = $this->getAuthUser()->company_id;
        $sales = Sale::where('company_id', $companyId)->orderBy('id', 'DESC')->get();
        return new SalesCollection($sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SalesRequest|Request $request
     * @return SalesResource
     */
    public function store(Request $request)
    {
        $sale = new Sale;

        $companyId = $this->getAuthUser()->company_id;
        $stock = $request->stock_id;

        if (request()->has('discount')) {
            $taxRate = request()->tax_rate;
            $discount = request()->discount;

            $totalAmount = request()->total_amount;

            $totalAmountOnDiscount = $totalAmount * $discount / 100;
            $receiptSignature = bin2hex(openssl_random_pseudo_bytes(10));

            $taxAmountOnDiscount = $totalAmountOnDiscount * $taxRate / 100;
            $subTotal = $totalAmountOnDiscount - $taxAmountOnDiscount;

            $sale->tax_rate = $taxRate;
            $sale->tax_amount = $taxAmountOnDiscount;
            $sale->sub_total = $subTotal;
            $sale->total_amount = $totalAmountOnDiscount;
            $sale->receipt_signature = $receiptSignature;
            $sale->company_id = $companyId;
            $sale->product_id = $request->product_id;
            $sale->client_id = $request->client_id;
            $sale->quantity_sold = $request->quantity_sold;
            $sale->unit_price = $request->unit_price;
            $sale->discount = $request->discount;

            //Get quantity available in stock
            $getCurrentStockQuantity = $this->getProductQuantity($stock);
            //Check if quantity to be sold is available and notify user
            if ($request->quantity_sold > $getCurrentStockQuantity) {
                return response(['message' => "Not enough stock, increase your stock"], Response::HTTP_BAD_REQUEST);
            }
            $this->deductStock($stock, $request->quantity_sold);
            $sale->save();
        } else {
            $taxRate = request()->tax_rate;

            $totalAmount = request()->total_amount;
            $receiptSignature = bin2hex(openssl_random_pseudo_bytes(10));

            $taxAmount = $totalAmount * $taxRate / 100;
            $subTotal = $totalAmount - $taxAmount;

            $sale->tax_rate = $taxRate;
            $sale->tax_amount = $taxAmount;
            $sale->sub_total = $subTotal;
            $sale->total_amount = $totalAmount;
            $sale->receipt_signature = $receiptSignature;
            $sale->company_id = $companyId;
            $sale->product_id = $request->product_id;
            $sale->client_id = $request->client_id;
            $sale->quantity_sold = $request->quantity_sold;
            $sale->unit_price = $request->unit_price;
            $sale->discount = $request->discount;

            //Get quantity available in stock
            $getCurrentStockQuantity = $this->getProductQuantity($stock);
            //Check if quantity to be sold is available and notify user
            if ($request->quantity_sold > $getCurrentStockQuantity) {
                return response(['message' => "Not enough stock, increase your stock"], Response::HTTP_BAD_REQUEST);
            }
            $this->deductStock($stock, $request->quantity_sold);
            $sale->save();
        }


        return new SalesResource($sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SalesRequest|Request $request
     * @param  \App\Sale $sale
     * @return SalesResource
     */
    public function update(Request $request, Sale $sale)
    {
        $sale = Sale::where("id", $sale->id)->first();

        $companyId = $this->getAuthUser()->company_id;
        $stock = $request->stock_id;

        if (request()->has('discount')) {
            $taxRate = request()->tax_rate;
            $discount = request()->discount;

            $totalAmount = request()->total_amount;

            $totalAmountOnDiscount = $totalAmount * $discount / 100;
            $receiptSignature = bin2hex(openssl_random_pseudo_bytes(10));

            $taxAmountOnDiscount = $totalAmountOnDiscount * $taxRate / 100;
            $subTotal = $totalAmountOnDiscount - $taxAmountOnDiscount;

            $sale->tax_rate = $taxRate;
            $sale->tax_amount = $taxAmountOnDiscount;
            $sale->sub_total = $subTotal;
            $sale->total_amount = $totalAmountOnDiscount;
            $sale->receipt_signature = $receiptSignature;
            $sale->company_id = $companyId;
            $sale->product_id = $request->product_id;
            $sale->client_id = $request->client_id;
            $sale->quantity_sold = $request->quantity_sold;
            $sale->unit_price = $request->unit_price;
            $sale->discount = $request->discount;

            //Get quantity available in stock
            $getCurrentStockQuantity = $this->getProductQuantity($stock);
            //Check if quantity to be sold is available and notify user
            if ($request->quantity_sold > $getCurrentStockQuantity) {
                return response(['message' => "Not enough stock, increase your stock"], Response::HTTP_BAD_REQUEST);
            }
            $this->deductStock($stock, $request->quantity_sold);
            $sale->save();
        } else {
            $taxRate = request()->tax_rate;

            $totalAmount = request()->total_amount;
            $receiptSignature = bin2hex(openssl_random_pseudo_bytes(10));

            $taxAmount = $totalAmount * $taxRate / 100;
            $subTotal = $totalAmount - $taxAmount;

            $sale->tax_rate = $taxRate;
            $sale->tax_amount = $taxAmount;
            $sale->sub_total = $subTotal;
            $sale->total_amount = $totalAmount;
            $sale->receipt_signature = $receiptSignature;
            $sale->company_id = $companyId;
            $sale->product_id = $request->product_id;
            $sale->client_id = $request->client_id;
            $sale->quantity_sold = $request->quantity_sold;
            $sale->unit_price = $request->unit_price;
            $sale->discount = $request->discount;

            //Get quantity available in stock
            $getCurrentStockQuantity = $this->getProductQuantity($stock);
            //Check if quantity to be sold is available and notify user
            if ($request->quantity_sold > $getCurrentStockQuantity) {
                return response(['message' => "Not enough stock, increase your stock"], Response::HTTP_BAD_REQUEST);
            }

            $this->deductStock($stock, $request->quantity_sold);
            $sale->save();
        }
        return new SalesResource($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * This private helps to return quantity of the stock
     * @param $stockId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function getProductQuantity($stockId)
    {
        $stock = Stock::find($stockId);
        if (!$stock) {
            return response('Stock not found', Response::HTTP_NOT_FOUND);
        }
        return $stock->quantity;
    }

    /**
     * This private deduct stock with current sold quantity
     * @param $stockId
     * @param $quantity
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function deductStock($stockId, $quantity)
    {
        $stock = Stock::find($stockId);
        if (!$stock) {
            return response('Stock not found', Response::HTTP_NOT_FOUND);
        }

        $currentQuantity = $stock->quantity;
        $newQuantity = $currentQuantity - $quantity;

        $stock->quantity = $newQuantity;
        $stock->save();
        return $stock->fresh();
    }
}
