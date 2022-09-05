<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Validator;
use App\Models\Inquiry;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customerId = $request->input('customerId');

        $validator = Validator::make($request->all(), [
            'customerId' => 'required|uuid',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => $validator->messages()
            ]);
        }
        // dd($customerId);
        $bills = Bill::where('user_uuid', $customerId)
               ->where('status', 'unpaid')
               ->first();
               
        $transactions = Transaction::where('user_uuid', $customerId)->first();
        
        if ($bills){
            $inquiry = new Inquiry();
            $inquiry->uuid = Str::uuid();
            $inquiry->bill_uuid = $bills->uuid;
            $inquiry->transaction_uuid = $transactions->uuid;
            $inquiry->is_expired = false;
            $inquiry->refNumber = rand(1, 999999);
            $inquiry->save();

            return response()->json([
                "customerId" => $bills->uuid,
                "monthUnpaid"=> $bills->month,
	            "amount" => $bills->amount,
            ]);
        }

        return response()->json([
            'status' => 404,
            'message' => "not found"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        //
    }
}
