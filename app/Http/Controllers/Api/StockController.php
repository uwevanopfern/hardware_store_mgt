<?php

namespace App\Http\Controllers\Api;

use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\StockCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Stock as StockResource;

class StockController extends Controller
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
     * @return StockCollection
     */
    public function index()
    {
        $companyId = $this->getAuthUser()->company_id;
        $stocks = Stock::where('company_id', $companyId)->orderBy('id', 'DESC')->get();
        return new StockCollection($stocks);
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
     * @param StockRequest|Request $request
     * @return StockResource
     */
    public function store(Request $request)
    {
        $stock = new Stock;

        $companyId = $this->getAuthUser()->company_id;

        $stock->company_id = $companyId;
        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;
        $stock->purchased_price = $request->purchased_price;
        $stock->unit_price = $request->unit_price;
        $stock->save();
        return new StockResource($stock);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock $stock
     * @return StockResource
     */
    public function show(Stock $stock)
    {
        return new StockResource($stock);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Stock $stock
     * @return StockResource
     */
    public function update(Request $request, Stock $stock)
    {
        $stock = Stock::where("id", $stock->id)->first();;

        $companyId = $this->getAuthUser()->company_id;

        $stock->company_id = $companyId;
        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;
        $stock->purchased_price = $request->purchased_price;
        $stock->unit_price = $request->unit_price;
        $stock->save();
        return new StockResource($stock);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     *Reports of stocks on different request type
     * @param Request $request
     * @return StockCollection
     */
    public function reports(Request $request)
    {
        $type = $request->type;
        $companyId = $this->getAuthUser()->company_id;
        $today = Carbon::now()->format('Y-m-d');
        //2020-09-13
        $start = Carbon::parse($request->start)->format('Y-m-d');
        $end = Carbon::parse($request->end)->format('Y-m-d');

        switch ($type) {

            case "DAILY":
                $stock = Stock::where('company_id', $companyId)->whereDate('updated_at', $today)->orderBy('id', 'DESC')->get();
                return new StockCollection($stock);
                break;

            case "DATES":
                $stock = Stock::where('company_id', $companyId)->whereBetween('updated_at', [$start, $end])->orderBy('id', 'DESC')->get();
                return new StockCollection($stock);
                break;

            default:
                return response(['Oops' => "Your choice is incorrect, use either DAILY, or DATES as type"]);
        }
    }
}
