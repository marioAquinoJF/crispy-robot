<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;
use Delivery\Http\Requests;
use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\ProductRepository;
use Delivery\Repositories\UserRepository;

class OrdersController extends Controller
{

    /**
     *
     * @var OrderRepository 
     */
    private $repository;

    /**
     *
     * @var OrderService 
     */
    private $service;
    /**
     *
     * @var ProductRepository 
     */
    private $productRepository;

    /**
     *
     * @var UserRepository 
     */
    private $userRepository;

    function __construct(OrderRepository $repository, ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->repository->with('items')->paginate(10);
        //  dd($orders);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->repository->with('deliveryman','items')->find($id);
        $users = $this->userRepository->deliveryMan()->lists('name', 'id');
        $client = $order->client;
        $products = $this->productRepository->all();
        return view('orders.show', compact('order', 'users', 'client','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = $this->userRepository->deliveryMan()->lists('name', 'id'); //findWhere(['role','=','deliveryMan']);
        $order = $this->repository->find($id);
        $orderStatus = $this->repository->status();
        $products = $this->productRepository->all();
        return view('orders.edit', compact('order', 'users', 'orderStatus','products'));
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
        $this->repository->update($request->all(), $id);
        return redirect()->back();
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

}
