<?php

namespace App\Services;
use App\Models\CartItem;
use App\Models\Order;

class OrderService
{
    public function getOrderData()
    {
        $orders = $this->getOrdersWithCartItems();
        $orderData = array_map(function($order) {
            return $this->mountOrderData($order);
        }, $orders->toArray());

        usort($orderData, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return $orderData;
    }

    public function getOrdersWithCartItems()
    {
        return Order::with('cartItems', function ($query) {
            $query->orderByDesc('created_at');
        })->get();
    }


    public function getLastItemAddedToCart($order)
    {
        return $order
                ->cartItems
                ->first()
                ->created_at ?? null;
    }

    public function isOrderCompleted($order)
    {
        return $order->status === 'completed';
    }

    private function mountOrderData($order)
    {
        $customer = $order->customer;
        $items = $order->items;

        $totalAmount = array_reduce($items->toArray(), function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return [
            'order_id' => $order->id,
            'customer_name' => $customer->name,
            'total_amount' => $totalAmount,
            'items_count' => $items->count(),
            'last_added_to_cart' => $this->getLastItemAddedToCart($order),
            'completed_order_exists' => $this->isOrderCompleted($order),
            'created_at' => $order->created_at,
        ];
    }
}