<?php

class OrderController{
    public function index(){
        $orders = (new Order)->all();
        return view("admin.orders.list", compact('orders'));
    }
}