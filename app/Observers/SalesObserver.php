<?php

namespace App\Observers;

use App\Sale;

class SalesObserver
{
    /**
     * Handle the contact "creating" event.
     * @param Sale $sale
     */
    public function creating(Sale $sale)
    {
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
            $sale->tax_rate = $receiptSignature;
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
            $sale->tax_rate = $receiptSignature;
        }
    }

    /**
     * Handle the sale "created" event.
     *
     * @param  \App\Sale $sale
     * @return void
     */
    public function created(Sale $sale)
    {
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
            $sale->tax_rate = $receiptSignature;
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
            $sale->tax_rate = $receiptSignature;
        }
    }

    /**
     * Handle the sale "updating" event.
     *
     * @param  \App\Sale $sale
     * @return void
     * @internal param Request $request
     */
    public function updating(Sale $sale)
    {
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
            $sale->tax_rate = $receiptSignature;
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
            $sale->tax_rate = $receiptSignature;
        }
    }

    /**
     * Handle the sale "updated" event.
     *
     * @param  \App\Sale $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "deleted" event.
     *
     * @param  \App\Sale $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "restored" event.
     *
     * @param  \App\Sale $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "force deleted" event.
     *
     * @param  \App\Sale $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
