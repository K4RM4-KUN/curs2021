<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\PaymentExecution;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subscription;
use App\Models\TransactionModel;

class PaymentController extends Controller
{
    //
    private $apiContext; 

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        ); 
    }

    public function payWithPayPal($id){
        $payer = new Payer;
        $payer->setPaymentMethod('paypal');  

        $amount = new Amount;
        $amount->setTotal('2.50');
        $amount->setCurrency('EUR');

        $transaction = new Transaction;
        $transaction->setAmount($amount);

        $callback = url('payment/status/'.$id);

        $redirectUrls = new RedirectUrls;
        $redirectUrls->setReturnUrl($callback)->setCancelUrl($callback);

        $payment = new Payment;
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try{
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());

        }
        catch(\PayPal\Exception\PayPalConnectionException $ex){
            echo $ex->getData();

        }
    }

    public function payPalStatus(Request $request){ 
        $paymentId = $request->input('paymentId');
        $token = $request->input('token');
        $payerID = $request->input('PayerID');

        if(!$paymentId || !$payerID || !$token){
            $status = "ERROR";
            return redirect('/')->with(compact('status')); //return to error blade

        }

        $payment = Payment::get($paymentId,$this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerID);

        $result = $payment->execute($execution,$this->apiContext); 
        
        $transaction = $payment->transactions; 

        $newTransaction = new TransactionModel;
        $newTransaction->SetAttribute('user_id',Auth::user()->id);
        $newTransaction->SetAttribute('payment_id',$paymentId);
        $newTransaction->SetAttribute('payer_id',$payerID);
        $newTransaction->SetAttribute('token',$token);
        $newTransaction->SetAttribute('email',$transaction[0]->payee->email);
        $newTransaction->SetAttribute('amount',$transaction[0]->amount->total);
        $newTransaction->SetAttribute('state',$result->getState());
        $newTransaction->save();

        $user = User::where('id',$request->id)->first();

        if($result->getState() === 'approved'){
            $status = 'El pago se ha realizado correctamente!';

            //DB aquí $request->id
            //Hacer middleware pre esto
            $newSubscription = new Subscription;
            $newSubscription->SetAttribute('user_id',$request->id);
            $newSubscription->SetAttribute('subscriber_id',Auth::user()->id);
            $newSubscription->SetAttribute('subscription_price',2.50);
            $newSubscription->SetAttribute('caducate_at',date("Y-m-d H:i:s", strtotime("+30 days")));
            $newSubscription->save();

            return redirect('results/'.$newSubscription->id.'/'.$newTransaction->id)->with(compact('status'));

        } 

        $status = 'El pago no se ha realizado correctamente, intentalo de nuevo!';

        return redirect('results')->with(compact('status',)); //result blade

    }

    public function  paymentResult($id = null,$transaction = null){
        if($id != null && $transaction != null ){
            $data['subscription'] = Subscription::where('id',$id)->first();
            $data['transaction'] = TransactionModel::where('id',$transaction)->first();
            $data['user'] = User::where('id',$data['subscription']->user_id)->first();

            if($data['subscription']->subscriber_id == Auth::user()->id){
                return view('payment.result',$data);

            } else{ 
                return redirect('usuario/ajustes/subscripciones');

            }

        } else {

            return redirect('usuario/ajustes/subscripciones');

        }
        
    }
}
