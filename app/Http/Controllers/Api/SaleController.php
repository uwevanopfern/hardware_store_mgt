<?php

namespace App\Http\Controllers\Api;

use App\Sale;
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
    public function store(SalesRequest $request)
    {
        $sale = new Sale;

        $companyId = $this->getAuthUser()->company_id;

        $sale->company_id = $companyId;
        $sale->product_id = $request->product_id;
        $sale->client_id = $request->client_id;
        $sale->quantity_sold = $request->quantity_sold;
        $sale->unit_price = $request->unit_price;
        $sale->discount = $request->discount;
        $sale->save();
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
    public function update(SalesRequest $request, Sale $sale)
    {
        $sale = Sale::where("id", $sale->id)->first();

        $companyId = $this->getAuthUser()->company_id;

        $sale->company_id = $companyId;
        $sale->product_id = $request->product_id;
        $sale->client_id = $request->client_id;
        $sale->quantity_sold = $request->quantity_sold;
        $sale->unit_price = $request->unit_price;
        $sale->discount = $request->discount;
        $sale->save();
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
}
