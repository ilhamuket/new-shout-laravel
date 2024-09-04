<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function createPayment(Request $request)
    {
        $orderId = uniqid();
        $grossAmount = 300000;

        $snapToken = $this->midtrans->createTransaction($orderId, $grossAmount);

        if ($snapToken) {
            return response()->json(['snap_token' => $snapToken]);
        } else {
            return response()->json(['error' => 'Failed to create transaction']);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment::index');
    }



}
