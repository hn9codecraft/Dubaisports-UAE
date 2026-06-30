<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Cart;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\BillingInfo;
use App\Models\StripeCustomer;
use App\Models\Stock;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\NomodService;
use App\Models\NomodCheckoutTransaction;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get()->toArray();

        $states = State::get()->toArray();

        $discountDetails = json_decode(\Session::get('cart_discount'), true);

        if(!\Auth::user()) {
            $cart = \Session::get('cart');
        } else {
            $userCart = Cart::where('user_id', \Auth::user()->id)->first();
            $cart = json_decode($userCart['products'], true);
        }
        if($cart) {
            $subTotal = array_sum(array_column($cart, 'productDiscountPrice'));
            $totalAmount = array_sum(array_column($cart, 'productDiscountPrice'));
            if($discountDetails) {
                $totalAmount -= $discountDetails['discount'];
                // $vat = ($totalAmount * 5) / 100; 
                $vat = 0;
                $totalAmount += $vat;
                $discountDetails['vat'] = $vat;
                \Session::put('cart_discount', json_encode($discountDetails));
            } else {
                // $vat = ($totalAmount * 5) / 100; 
                $vat = 0;
                $totalAmount += $vat;
            }
        }

        if(empty($cart)) {
            return redirect()->route('home');
        }

        return view('frontend.checkout', compact('cart', 'subTotal', 'totalAmount', 'countries', 'states', 'discountDetails', 'vat'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try {

            $validated = $request->validate([
                    'first_name' => 'required|max:255',
                    'phone' => 'required|numeric|digits:10',
                    'email' => 'required|max:255', //unique:users
                ]);

            $data = $request->all();
            $discountDetails = \Session::get('cart_discount');
            $discountDetails = json_decode($discountDetails, true);
            $discountDetails['delivery_charge'] = $data['delivery_charge'];
            
            if($data['delivery_type'] == 'Delivery') {
                $validated = $request->validate([
                    'address_line_1' => 'required|max:50',
                    'country_id' => 'required',
                    // 'state_id' => 'required',
                    'city' => 'required',
                ]);
            }
            // if($data['payment_type'] == 'Credit Card') {
            //     $validated = $request->validate([
            //         'card_number' => 'required|max:19',
            //         'card_holder_name' => 'required',
            //         'expiry_date' => 'required',
            //         'cvv' => 'required|max:4',
            //     ]);
            // }

            if(!\Auth::user()) {
                $user = User::where('email', $data['email'])->first();
                if(!$user) {
                    $user = User::create([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['first_name'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'password' => \Hash::make('123456'),
                    ]);
                }
                $cart = \Session::get('cart');
                
                Cart::updateOrCreate([
                    'user_id' => $user['id']
                ],[
                    'user_id' => $user['id'],
                    'products' => json_encode($cart)
                ]);
                \Auth::loginUsingId($user['id']);
            } else {
                $user = \Auth::user();
                $cart = Cart::where('user_id', \Auth::user()->id)->first();
                $cart = json_decode($cart['products'], true);
            }

            // $cartTotalAmount = array_sum(array_column($cart, 'price'));
            $cartTotalAmount = $data['total_amount_submit'];

            if($user && $data['delivery_type'] == 'Delivery') {
                // Address::create([
                //     'user_id' => $user['id'],
                //     'address_line_1' => $data['address_line_1'],
                //     'address_line_2' => $data['address_line_2'],
                //     'country_id' => $data['country_id'],
                //     'state_id' => $data['state_id'],
                //     'city' => $data['city'],
                // ]);

            }

            // Test Working Stripe
            // if($data['payment_type'] == 'Credit Card') {
            //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            //     $products = [];
            //     foreach ($cart as $key => $value) {
            //             $products[] = [
            //                 'price_data' => [
            //                     'currency' => 'aed',
            //                     'product_data' => [
            //                         'name' => $value['product']['title'],
            //                     ],
            //                     'unit_amount' => ($value['productDiscountPrice'] / $value['quantity']) * 100
            //                 ],
            //                 'quantity' => $value['quantity']
            //             ];
            //     }

            //     $checkoutSessionArray = [
            //         'line_items' => $products,
            //         'mode' => 'payment',
            //         'payment_method_types' => ['card'],
            //         'success_url' => env('APP_URL') . 'checkout/success',
            //         'cancel_url' => env('APP_URL') . 'checkout',
            //         'automatic_tax' => [
            //         'enabled' => true,
            //         ],
            //     ];
            //     if(!empty($discountDetails) && isset($discountDetails['coupon_code'])) {
            //         $checkoutSessionArray['discounts'] = [
            //                 [
            //                     'coupon' => $discountDetails['coupon_code']
            //                 ]
            //             ];
                        
            //     }
            //     if(!empty($discountDetails) && isset($discountDetails['delivery_charge']) && $discountDetails['delivery_charge'] > 0) {
            //         $checkoutSessionArray['shipping_options'] = [
            //                 [
            //                 'shipping_rate_data' => [
            //                     'display_name' => 'Delivery Charge',
            //                     'type' => 'fixed_amount',
            //                     'fixed_amount' => [ 
            //                         'amount' =>  ($discountDetails['delivery_charge'] * 100),
            //                         'currency' => 'aed'
            //                     ]        
            //                 ]
            //             ]
            //         ];
            //     }
                
            //     $checkout_session = \Stripe\Checkout\Session::create($checkoutSessionArray);
                
                // \Session::put('checkoutSessionId', $checkout_session->id);
                // \Session::put('checkoutDetails', json_encode($data));

            //     return redirect()->away($checkout_session->url);
                
            //     // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            //     // try {
            //     //     $cardToken = \Stripe\Token::create(array(
            //     //         'card' => array(
            //     //             'number' => str_replace(' ', '', $data['card_number']),
            //     //             'exp_month' => explode('/', $data['expiry_date'])[0],
            //     //             'exp_year' => explode('/', $data['expiry_date'])[1],
            //     //             'cvc' => $data['cvv']
            //     //         ),
            //     //     ));
            //     // } catch(\Exception $e) {
            //     //     return back()->withErrors(['card_number' => $e->getMessage(), 'payment_type' => 'Credit Card']);
            //     // }

            //     // $stripeCustomer = StripeCustomer::where('user_id', $user['id'])->first();

            //     // if(!$stripeCustomer) {
            //     //     $stripeCustomer = \Stripe\Customer::create(array(
            //     //         "email" => $user['email'],
            //     //         "name" => $user['first_name'] .' '.$user['last_name'],
            //     //         // "source" => $cardToken->id
            //     //     ));
            //     //     $customer_token = $stripeCustomer->id;

            //     //     StripeCustomer::create([
            //     //         'user_id' => $user['id'],
            //     //         'stripe_customer_id' => $customer_token
            //     //     ]);


            //     // } else {
            //     //     $customer_token = $stripeCustomer['stripe_customer_id'];
            //     // }
            //     // $cardAttach = \Stripe\Customer::createSource(
            //     //     $customer_token,
            //     //     ['source' => $cardToken->id]
            //     // );
            //     // $charge = \Stripe\Charge::create(array(
            //     //     'amount' => $cartTotalAmount * 100,
            //     //     'currency' => 'AED',
            //     //     'customer' => $customer_token,
            //     //     'source' => $cardAttach->id,
            //     //     'description' => ''
            //     // ));

            //     // if($charge->status === 'succeeded') {
            //     //     $order = Order::create([
            //     //         'user_id' => $user['id'],
            //     //         'products' => json_encode($cart),
            //     //         'delivery_type' => $data['delivery_type'],
            //     //         'shipping_note' => $data['shipping_information'],
            //     //         'discount' => json_encode($discountDetails),
            //     //         'address' => json_encode([
            //     //             'address_line_1' => $data['address_line_1'],
            //     //             'address_line_2' => $data['address_line_2'],
            //     //             'country_id' => $data['country_id'],
            //     //             'state_id' => $data['state_id'],
            //     //             'city' => $data['city'],
            //     //         ]),
            //     //         'delivery_charge' => $data['delivery_charge'],
            //     //         'vat' => $data['vat'],
            //     //     ]);

            //     //     Payment::create([
            //     //         'user_id' => $user['id'],
            //     //         'order_id' => $order['id'],
            //     //         'txn_id' => $charge->id,
            //     //         'payment_type' => $data['payment_type'],
            //     //         'price' => $cartTotalAmount
            //     //     ]);

            //     //     //--- Debit Product Stock
            //     //     foreach ($cart as $key => $value) {
            //     //         Stock::create([
            //     //             'product_id' => $value['product']['id'],
            //     //             'type' => 'Debit',
            //     //             'qty' => $value['quantity'],
            //     //             'note' => 'Order #'.$order['id']
            //     //         ]);
            //     //     }

            //     //     \Auth::loginUsingId($user['id']);
            //     // } else {
            //     //     return redirect()->back();
            //     // }
            // }
            // Test End Working Stripe

 
            if($data['payment_type'] == 'Credit Card') {
                // // 2. Make the API request
                // $response = Http::withHeaders([
                //     'Authorization' => 'Bearer sk_live_vZFRYxfi.9pNFbTfsoOWgBh9nByynu6atsUEdnx9A',
                //     'Content-Type'  => 'application/json',
                //     'Accept'        => 'application/json',
                // ])->post(env('NOMOD_BASE_URL') . '/links', [
                //     'amount'      => (int) ($cartTotalAmount * 100), 
                //     'currency'    => "AED",
                //     'description' => 'Order Payment',
                //     'success_url' => config('app.url'), // route('payment.success'),
                //     'cancel_url'  => config('app.url') // route('payment.cancel'),
                // ]);
 
                // Prepare items
                $items = [
                    // [
                    //     'item_id'     => 'ORDER_PAYMENT',       // unique string
                    //     'name'        => 'Order Payment',       // item name
                    //     'quantity'    => 1,
                    //     'unit_amount' => (string) $cartTotalAmount,
                    // ]
                ];

                foreach ($cart as $key => $value) {
                    $items[] = [
                        'item_id' => $value['product']['id'],
                        'name'        => $value['product']['title'],       // item name
                        'quantity'    => $value['quantity'],
                        'unit_amount' => ($value['productDiscountPrice'] / $value['quantity']),
                    ];
                }
 

                try {
                    // Call the service to create checkout
                    $checkoutResponse = NomodService::createCheckout([
                        'reference_id'  => 'REF_' . time(),
                        'amount'        => (string) $cartTotalAmount,
                        'currency'      => 'AED',
                        'items'         => $items,
                        'success_url'   => route('front.checkout.nomod.success'),
                        'failure_url'   => route('home'),
                        'cancelled_url' => route('home'),
                    ]);

 
                    if (!empty($checkoutResponse['id']) && !empty($checkoutResponse['url'])) {
                        // Store response in the database
                        $transaction = NomodCheckoutTransaction::create([
                            'reference_id'     => $checkoutResponse['reference_id'] ?? 'REF_' . time(),
                            'amount'           => $checkoutResponse['amount'] ?? $cartTotalAmount,
                            'currency'         => $checkoutResponse['currency'] ?? 'AED',
                            'status'           => $checkoutResponse['status'] ?? 'created',
                            'checkout_response'=> $checkoutResponse, // store full JSON
                        ]);

                        \Session::put('nomodCheckoutSessionId', $checkoutResponse['id']);
                        \Session::put('nomodCheckoutDetails', json_encode($data));

                        // return redirect()->away($checkoutResponse['url']);

                        if ($transaction->id) {
                            return redirect()->route('nomod.processing', ['id' => $transaction->id]);
                        } 
                    }
 
                    // Redirect to processing page with DB record ID
                    
                     
                } catch (\Exception $e) {
                    Log::channel('nomod')->error('Nomod Checkout creation failed', [
                        'message' => $e->getMessage(),
                    ]);

                    return back()->withErrors('Unable to initiate payment.');
                }
            } else {
                $order = Order::create([
                    'user_id' => $user['id'],
                    'products' => json_encode($cart),
                    'delivery_type' => $data['delivery_type'],
                    'shipping_note' => !empty($data['shipping_information']) ? $data['shipping_information'] : "",
                    'discount' => json_encode($discountDetails),
                    'address' => json_encode([
                        'address_line_1' => !empty($data['address_line_1']) ? : "",
                        'address_line_2' => !empty($data['address_line_2']) ? : "",
                        'country_id' => $data['country_id'],
                        // 'state_id' => $data['state_id'],
                        'city' => $data['city'],
                    ]),
                    'delivery_charge' => $data['delivery_charge'],
                    'vat' => $data['vat'],
                ]);
                Payment::create([
                    'user_id' => $user['id'],
                    'order_id' => $order['id'],
                    'txn_id' => '',
                    'payment_type' => $data['payment_type'],
                    'price' => $cartTotalAmount
                ]);

                //--- Debit Product Stock
                foreach ($cart as $key => $value) {
                    Stock::create([
                        'product_id' => $value['product']['id'],
                        'type' => 'Debit',
                        'qty' => $value['quantity'],
                        'note' => 'Order #'.$order['id']
                    ]);
                }

                \Auth::loginUsingId($user['id']);
            }
            BillingInfo::create([
                'order_id' => $order['id'],
                'name' => $data['first_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
            ]);
            if(\Auth::user()){
                Cart::where('user_id', \Auth::user()->id)->delete();
            }
            \Session::forget('cart');
            return redirect()->route('front.orders.index');

        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function success(Request $request) {
        $sessionId = \Session::get('checkoutSessionId');
        $checkoutDetails = \Session::get('checkoutDetails');
        
        if($sessionId) {
            $checkoutDetails = json_decode($checkoutDetails, true);

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentResponse = \Stripe\Checkout\Session::retrieve($sessionId);

            $discountDetails = \Session::get('cart_discount');
            $discountDetails = json_decode($discountDetails, true);
            $discountDetails['delivery_charge'] = $checkoutDetails['delivery_charge'];

            $user = \Auth::user();
            $cart = Cart::where('user_id', $user['id'])->first();
            $products = json_decode($cart['products'], true);
            $order = Order::create([
                'user_id' => $user['id'],
                'products' => $cart['products'],
                'delivery_type' => $checkoutDetails['delivery_type'],
                'shipping_note' => $checkoutDetails['shipping_information'],
                'discount' => json_encode($discountDetails),
                'address' => json_encode([
                    'address_line_1' => $checkoutDetails['address_line_1'],
                    'address_line_2' => $checkoutDetails['address_line_2'],
                    'country_id' => $checkoutDetails['country_id'],
                    'state_id' => $checkoutDetails['state_id'],
                    'city' => $checkoutDetails['city'],
                ]),
                'delivery_charge' => $checkoutDetails['delivery_charge'],
                'vat' => $checkoutDetails['vat'],
            ]);

            Payment::create([
                'user_id' => $user['id'],
                'order_id' => $order['id'],
                'txn_id' => $paymentResponse->payment_intent,
                'payment_type' => $checkoutDetails['payment_type'],
                'price' => ($paymentResponse->amount_total) / 100
            ]);

            //--- Debit Product Stock
            foreach ($products as $key => $value) {
                Stock::create([
                    'product_id' => $value['product']['id'],
                    'type' => 'Debit',
                    'qty' => $value['quantity'],
                    'note' => 'Order #'.$order['id']
                ]);
            }
            if(\Auth::user()){
                Cart::where('user_id', \Auth::user()->id)->delete();
            }
            \Session::forget('cart');
            \Session::forget('checkoutSessionId');
            \Session::forget('checkoutDetails');
            \Session::forget('cart_discount');
            return redirect()->route('front.orders.index');
        } else {
            return redirect()->route('front.checkout.index');
        }
        
    }


 
    public function nomodSuccess(Request $request)
    {
        //  \Session::put('nomodCheckoutSessionId', $checkoutResponse['id']);
        //  \Session::put('nomodCheckoutDetails', json_encode($data));

        $userCart = Cart::where('user_id', \Auth::user()->id)->first();
        $cart = json_decode($userCart['products'], true);
        $transactionId = $request->query('transactionId');

        $transaction = NomodCheckoutTransaction::find($transactionId);
        if (empty($transaction)) {
            return response()->json(['error' => "Something went wrong"]);
        }
        
        Log::info('Nomod success callback hit', [
            'user_id' => auth()->id(),
            'nomodCheckoutSessionId' => session('nomodCheckoutSessionId'),
            'nomodCheckoutDetails' => session('nomodCheckoutDetails'),
            'request Data' => $request->all(),
        ]);

        try {
            // $nomodCheckoutSessionId = session('nomodCheckoutSessionId');
            // $nomodCheckoutDetails = session('nomodCheckoutDetails');

            $sessionId = \Session::get('nomodCheckoutSessionId');
            $checkoutDetails = \Session::get('nomodCheckoutDetails');
            
            if($sessionId) {
                $checkoutDetails = json_decode($checkoutDetails, true);

                // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                // $paymentResponse = \Stripe\Checkout\Session::retrieve($sessionId);

                $discountDetails = \Session::get('cart_discount');
                $discountDetails = json_decode($discountDetails, true);
                $discountDetails['delivery_charge'] = $checkoutDetails['delivery_charge'];

                $user = \Auth::user();
                $cart = Cart::where('user_id', $user['id'])->first();
                $products = json_decode($cart['products'], true);
                $order = Order::create([
                    'user_id' => $user['id'],
                    'products' => $cart['products'],
                    'delivery_type' => $checkoutDetails['delivery_type'],
                    'shipping_note' => $checkoutDetails['shipping_information'] ?? "",
                    'discount' => json_encode($discountDetails),
                    'address' => json_encode([
                        'address_line_1' => $checkoutDetails['address_line_1'] ?? "",
                        'address_line_2' => $checkoutDetails['address_line_2'] ?? "",
                        'country_id' => $checkoutDetails['country_id'] ?? "",
                        'state_id' => $checkoutDetails['state_id'] ?? "",
                        'city' => $checkoutDetails['city'] ?? "",
                    ]),
                    'delivery_charge' => $checkoutDetails['delivery_charge'],
                    'vat' => $checkoutDetails['vat'],
                ]);

  
                Payment::create([
                    'user_id' => $user['id'],
                    'order_id' => $order['id'],
                    'txn_id' => $transactionId,
                    'payment_type' => $checkoutDetails['payment_type'],
                    'price' =>  $transaction->amount 
                ]);

                //--- Debit Product Stock
                foreach ($products as $key => $value) {
                    Stock::create([
                        'product_id' => $value['product']['id'],
                        'type' => 'Debit',
                        'qty' => $value['quantity'],
                        'note' => 'Order #'.$order['id']
                    ]);
                }
                if(\Auth::user()){
                    Cart::where('user_id', \Auth::user()->id)->delete();
                }
                \Session::forget('cart');
                \Session::forget('checkoutSessionId');
                \Session::forget('checkoutDetails');
                \Session::forget('cart_discount');
                return redirect()->route('front.orders.index');
            } else {
                return redirect()->route('front.checkout.index');
            }

        } catch (\Throwable $e) {

            Log::error('Nomod success exception', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => substr($e->getTraceAsString(), 0, 2000),
                'user_id' => auth()->id(),
                'link_id' => session('nomod_link_id'),
            ]);

            return redirect()->route('front.checkout.index')
                ->withErrors('Something went wrong while processing payment.');
        }
    }
 
    public function nomodCancel(Request $request)
    {
        Log::info('Nomod cancel callback hit', [
            'user_id' => auth()->id(),
            'request_query' => $request->query(),
        ]);

        try {
            session()->forget(['nomod_link_id', 'checkoutDetails']);

            return redirect()->route('front.checkout.index')
                ->withErrors('Payment cancelled.');

        } catch (\Throwable $e) {

            Log::error('Nomod cancel exception', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => substr($e->getTraceAsString(), 0, 2000),
            ]);

            return redirect()->route('front.checkout.index');
        }
    }
    
    public function nomodProcessingPage($id)
    {
        $transaction = NomodCheckoutTransaction::findOrFail($id);

        return view('nomod.processing', [
            'transactionId' => $transaction->id
        ]);
    }

    public function checkNomodPaymentStatus()
    {
        $transactionId = request('transaction_id');

        
        $transaction   = NomodCheckoutTransaction::find($transactionId);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $checkoutId = $transaction->checkout_response['id'] ??  null;

        if (!$checkoutId) {
            return response()->json([
                'success' => false,
                'message' => 'No checkout ID found for this transaction'
            ], 400);
        }

        $checkout = NomodService::getCheckout($checkoutId);

        // // Update DB with latest response
        // $transaction->update([
        //     'checkout_response' => json_encode($checkout),
        //     'status'            => $checkout['status'] ?? $transaction->status,
        // ]);

        return response()->json([
            'success'  => true,
            'status'   => $checkout['status'] ?? 'unknown',
            'checkout' => $checkout
        ]);
    }
 
    /**
     * Get a NomodCheckoutTransaction by ID and return JSON response
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNomodTransactionById($id)
    {
        $transaction = NomodCheckoutTransaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'success'     => true,
            'transaction' => $transaction
        ]);
    }


}
