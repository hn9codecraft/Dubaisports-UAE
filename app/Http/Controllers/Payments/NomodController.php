<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NomodController extends Controller
{
    public function createLink(Request $request)
    {
        /**
         * RULE:
         * amount MUST be in major currency unit
         * Example: 100 = $100
         */

        // 1. Validate request
        $validator = Validator::make($request->all(), [
            'amount'      => 'required|numeric|min:1|max:100000', // safety upper bound
            'currency'    => 'required|string|size:3',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            Log::warning('Nomod Validation Failed', [
                'errors' => $validator->errors()->toArray(),
                'request' => $request->only(['amount', 'currency'])
            ]);

            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 2. Convert amount → smallest unit (USD/AED/etc.)
            $rawAmount = (float) $request->amount;
            $currency  = strtoupper($request->currency);

            // For now: USD, AED, INR etc. (2 decimal currencies)
            $amountInMinorUnit = (int) round($rawAmount * 100);

            // Safety guard (prevents accidental overcharge)
            if ($amountInMinorUnit <= 0 || $amountInMinorUnit > 10_000_000) {
                throw new \Exception('Invalid amount after conversion');
            }

            // 3. Prepare items
            $items = [
                [
                    'name'     => $request->description ?: 'Order Payment',
                    'amount'   => $amountInMinorUnit,
                    'quantity' => 1,
                ]
            ];

            Log::info('Nomod Link Creation Payload', [
                'raw_amount' => $rawAmount,
                'converted_amount' => $amountInMinorUnit,
                'currency' => $currency,
            ]);

            // 4. Call Nomod API
            $response = Http::withHeaders([
                'X-API-KEY' => config('services.nomod.key'),
                'Accept' => 'application/json',
            ])->post(config('services.nomod.base_url') . '/links', [
                'currency'    => $currency,
                'items'       => $items,
                'success_url' => url('/success'),
                'cancel_url'  => url('/cancel'),
            ]);

            // 5. Handle response
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'payment_url' => $response->json('url'),
                ]);
            }

            Log::error('Nomod API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Nomod API error',
            ], 400);

        } catch (\Throwable $e) {
            Log::critical('Nomod Exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Payment initialization failed',
              	'E_MSG' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Nomod success redirect (UI only)
     */
    public function success(Request $request)
    {
        Log::info('Nomod success redirect received', [
            'query' => $request->all(),
        ]);

        return redirect()->route('home');
    }

    /**
     * Nomod cancel redirect
     */
    public function cancel(Request $request)
    {
        Log::info('Nomod cancel redirect received', [
            'query' => $request->all(),
        ]);

        return redirect()->route('home');
    }
}
