<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderService;

    public function __construct()
    {
        $this->orderService = app('App\Services\OrderService');
    }

    public function index()
    {
        $orderData = $this->orderService->getOrderData();
        return view('orders.index', compact('orderData'));
    }
}