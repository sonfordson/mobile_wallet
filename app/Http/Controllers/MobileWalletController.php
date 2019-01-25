<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_mobile_customer_detail;
use App\Tbl_mobile_wallet_detail;
use Nexmo\Account\Balance;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Tbl_main_transaction;
use App\Tbl_subtransaction;
use App\Tbl_business_account;
use Uuid;
use Carbon\Carbon;
use App\Tbl_charge;


class MobileWalletController extends Controller
{

    public function transfer_fund(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'account_balance' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'input_invalid',
                    'message' => $validator->errors()->all()
                ]
            ], 422);
        }

        $phone = $request->input('phone_number');
        $amount = $request->input('account_balance');


        $recipient = Tbl_mobile_customer_detail::where('phone_number', $phone)->first();
        if (!$recipient) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'user_not_found',
                    'message' => 'User with phone provided does not exist....'
                ]
            ], 404);
        }


        $requestData = $request->all();
        $my_balance = Tbl_mobile_wallet_detail::findOrFail(2);

        $initial_balance = $my_balance->account_balance;
        $final_balance = $my_balance->account_balance - $initial_balance;
        $transfered_amount = $initial_balance - $final_balance;
        $requestData['phone_number'] = $my_balance->phone_number;

        $balance = Tbl_mobile_wallet_detail::findOrFail(3);

        // $user = Auth::user();

        // $deposits = $user->deposits()->sum('amount');
        // $withdrawals = $user->withdrawals()->sum('amount');
        // $output_cash = Transaction::userTransfers($user->id)->sum('amount');
        // $input_cash = Transaction::userReceipts($user->id)->sum('amount');

        // $wallet_amt = ($deposits + $input_cash) - ($output_cash + $withdrawals);

        // if ($amount > $wallet_amt) {
        //     return response()->json([
        //         'status' => 'error',
        //         'error' => [
        //             'code' => 'insufficient_funds',
        //             'message' => 'You have insufficient funds....'
        //         ]
        //     ], 412);
        // }

        $requestData['account_balance'] = $balance->account_balance + $amount;

        $balance->update($requestData);

        //main transaction
        $transaction = new Tbl_main_transaction;
        $transaction->uuid = Uuid::generate();
        $transaction->receipt = str_random(5);
        $transaction->request_id = rand();
        $transaction->partya = 2;
        $transaction->partyb = 3;
        $transaction->amount = 2000;
        $transaction->charge = 112;
        $transaction->status = 'completed';
        $transaction->date = date('Y-m-d H:i:s');
        $transaction_number = str_random(10);
        $transaction->save();

        // subtransaction
        $subtransaction = new Tbl_subtransaction;
        $subtransaction->uuid = Uuid::generate();
        $subtransaction->receipt = str_random(5);
        $subtransaction->request_id = rand();
        $subtransaction->phone = $my_balance->phone_number;
        $subtransaction->amount = $final_balance;
        $subtransaction->amount_type = 'charge';
        $subtransaction->transaction_type = 'credit';
        $subtransaction->save();

        // account balance
        $biz_account = new Tbl_business_account;
        $biz_account->uuid = Uuid::generate();
        $biz_account->account_name = 'XYZ TELCO';
        $biz_account->account_no = rand();
        $biz_account->account_balance = $transfered_amount;
        $biz_account->status = 'completed';
        $biz_account->last_activity = 'Some Transaction';
        $biz_account->save();

        return $balance;

    }

    // transaction details per receipt
    public function transaction_details(Request $request)
    {
        $keyword = $request->get('receipt');
        $perPage = 2;
        if (!empty($keyword)) {
            $transaction_details = Tbl_subtransaction::where('receipt', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $transaction_details = Tbl_subtransaction::whereReceipt('receipt')->Paginate($perPage);
        }
        return $transaction_history;
    }

    // transaction history by phone number and start-date and end-date
    public function transaction_history(Request $request)
    {
        $keyword = $request->get('phone');
        $perPage = 4;
        if (!empty($keyword)) {
            $transaction_history = Tbl_subtransaction::where('created_at', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $transaction_history = Tbl_subtransaction::whereDate('created_at', Carbon::today())->Paginate($perPage);
        }
        return $transaction_history;

    }



}
