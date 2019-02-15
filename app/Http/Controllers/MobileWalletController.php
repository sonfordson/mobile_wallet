<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_mobile_customer_detail;
use App\Tbl_mobile_wallet_detail;
use Nexmo\Account\Balance;
use Illuminate\Support\Facades\Validator;
use App\Tbl_main_transaction;
use App\Tbl_subtransaction;
use App\Tbl_business_account;
use Uuid;
use Auth;
use Carbon\Carbon;
use App\Tbl_charge;


class MobileWalletController extends Controller
{

    public function transfer_fund(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required', 'numeric', 'regex:/^(254|0)7[0-8]{8}/',
            'pin' => 'required',
            'account_balance' => 'required|numeric|min:1|max:69999',
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

        $pin = $request->input('pin');
        $phone = $request->input('phone_number');
       

         


        // checking the valid/invalid pin
        $sender_pin_validation = Tbl_mobile_wallet_detail::where('pin', $pin)->first();
        if (!$sender_pin_validation) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'pin_not_found',
                    'message' => 'Invalid Wallet pin number....'
                ]
            ], 404);
        }

        // checking the valid/invalid phone number
        $check = substr($phone, -9);
        $recipient = Tbl_mobile_customer_detail::where('phone_number',  'LIKE', "%$check")->first();
            if (!$recipient) {
                return response()->json([
                    'status' => 'error',
                    'error' => [
                        'code' => 'user_not_found',
                        'message' => 'User with phone provided does not exist....'
                    ]
                ], 404);
            }

            // adding charges to the transactions registered users
        $my_balance = Tbl_mobile_wallet_detail::findOrFail(2);
        $balance = Tbl_mobile_wallet_detail::findOrFail(3);
        $registered_users = Tbl_mobile_wallet_detail::where('status', true)->first();
      

        // if($registered_users->status = false) {
        //       $charges =  Tbl_charge::findOrFail(2);
        //       dd($charges);
                
        //                 $total_transaction_amount = $amount + $charges->send_to_registered_user;
        //                 $requestData = $request->all();
        //                 $initial_balance = $my_balance->account_balance;
        //                 $final_balance = $my_balance->account_balance - $initial_balance;
        //                 $transfered_amount = $initial_balance - $final_balance;
    
        // }

        // adding charges to the transactions unregistered users
        // $unregistered_users = Tbl_mobile_wallet_detail::where('status', false)->first();
        // dd($unregistered_users);


        //constraint checking minimum amount to transfer
        $requestData['phone_number'] = $my_balance->phone_number;

        $amount = $request->input('account_balance');
        $requestData['account_balance'] = $balance->account_balance + $amount;

         if ($requestData['account_balance'] < 0 ) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'insufficient_funds',
                    'message' => 'You have insufficient funds....'
                ]
            ], 412);

        //constraint checking maximum amount to transfer
        }if($requestData['account_balance'] > 69999 ) {
            return response()->json([
                'status' => 'error',
                'error' => [
                    'code' => 'overpayment_of_funds',
                    'message' => 'You have insufficient funds....'
                ]
            ], 412);
        }

        $balance->update($requestData);

        //XYZ main_transaction
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

        // XYZ sub_transaction 
        $subtransaction = new Tbl_subtransaction;
        $subtransaction->uuid = Uuid::generate();
        $subtransaction->receipt = str_random(5);
        $subtransaction->request_id = rand();
        $subtransaction->phone = $my_balance->phone_number;
        $subtransaction->amount = "4000";
      
        
        $subtransaction->amount_type = 'charge';
        $subtransaction->transaction_type = 'credit';
        $subtransaction->save();

   
        // XYZ transaction for account 234567 
        $biz_account_a = 234567;
    
        if($biz_account_a) {
        $biz_account = new Tbl_business_account;
        $biz_account->uuid = Uuid::generate();
        $biz_account->account_name = 'XYZ TELCO';
        $biz_account->account_no = $biz_account_a;
        $biz_account->account_balance = 4;
        $biz_account->status = 'completed';
        $biz_account->last_activity = 'Some Transaction';
        $biz_account->save();
        }

       // XYZ transaction for account 345678 
        $biz_account_b = 345678;

        if($biz_account_b) {
        $biz_account = new Tbl_business_account;
        $biz_account->uuid = Uuid::generate();
        $biz_account->account_name = 'XYZ TELCO';
        $biz_account->account_no = $biz_account_b;
        $biz_account->account_balance = 4;
        $biz_account->status = 'completed';
        $biz_account->last_activity = 'Some Transaction';
        $biz_account->save();
        }

        // XYZ transaction for account 746271 
        $biz_account_c = 746271;

        if($biz_account_c) {
        $biz_account = new Tbl_business_account;
        $biz_account->uuid = Uuid::generate();
        $biz_account->account_name = 'XYZ TELCO';
        $biz_account->account_no = $biz_account_c;
        $biz_account->account_balance = 4;
        $biz_account->status = 'completed';
        $biz_account->last_activity = 'Some Transaction';
        $biz_account->save();
        }

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
