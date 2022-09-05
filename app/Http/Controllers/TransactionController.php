<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Resources\TransactionSingleResource;
use App\Models\Bill;
use App\Models\Inquiry;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
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
        $data = $request->input('refNumber');
        
        $validator = Validator::make($request->all(), [
            'refNumber' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->messages()
            ]);
        }
        $inquiry = Inquiry::where('refNumber', $data)
                 ->first();

        if (empty($inquiry)) {
            return response()->json([
                'status' => 412,
                'message' => "referral number not found!"
            ], 412);
        } elseif ($inquiry) {
            $bill = Bill::where('uuid', $inquiry->bill_uuid)->first();

            $transaction = new Transaction();
            $transaction->uuid = Str::uuid();
            $transaction->user_uuid = $bill->user_uuid;
            $transaction->status = "pending";
            $transaction->save();

            // reduce user balance.
            $reduce = User::findOrFail($bill->user_uuid);
            $reduce->update([
                'balance' => $reduce->balance - $bill->amount,
            ]);
        }
        
        $transaction = Transaction::first();
        return response()->json([
            "status" => 201,
            "customerId" => $transaction->user_uuid,
            "transactionId" => $transaction->uuid,
            "message" => $transaction->status,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $bill = Bill::where('user_uuid', $transaction->user_uuid)
              ->first();

        return response()->json([
            "transactionId" => $transaction->uuid,
            "status" => $transaction->status,
            "monthPaid" => $bill->month,
            "amountPaid" => number_format($bill->amount, 2, '.', ''),
            "paidAt" => date('Y-m-d h:i:s', strtotime($bill->created_at)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
