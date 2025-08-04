<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mahedi250\Bkash\Facade\CheckoutUrl;

class BkashPaymentController extends Controller
{
    public function pay(Request $request)
    {
        // Validate the amount
        $request->validate([
            'amount' => 'required|numeric|min:1|max:100000'
        ], [
            'amount.required' => 'Please enter an amount',
            'amount.numeric' => 'Amount must be a number',
            'amount.min' => 'Amount must be at least ৳1',
            'amount.max' => 'Amount cannot exceed ৳100,000'
        ]);

        $amount = $request->input('amount');
        $response = CheckoutUrl::Create(1000,['payerReference'=>"01929918378",'merchantInvoiceNumber'=>"Inv_123"]);
        return redirect($response->bkashURL);
    }

    
    public function callback(Request $request)
    {
        $status = $request->input('status');
        $paymentId = $request->input('paymentID');

        if ($status === 'success')
        {
            $response = CheckoutUrl::MakePayment($paymentId);

            if ($response->statusCode !== '0000')
            {
            return CheckoutUrl::Failed($response->statusMessage);
            }

            if (isset($response->transactionStatus)&&($response->transactionStatus=='Completed'||$response->transactionStatus=='Authorized'))
            {
                 //Database Insert Operation
                return CheckoutUrl::Success($response->trxID."({$response->transactionStatus})");
            }
            else if($response->transactionStatus=='Initiated')
            {

                return CheckoutUrl::Failed("Try Again");
            }

        }

        else
        {
          return CheckoutUrl::Failed($status);
        }
    }

}
