<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = Cart::getContent();

        if (!count($cartItems)) {
            return redirect()->route('products.list');
        }

        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            ),
        ]);
        // session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity,
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function finishCart(FinishCartRequest $request)
    {
        $order = new Order($request->validated());
        $order->save();
        
        $mailData = [
            'title' => 'Nova porudzbina',
            'body' => 'Detalji',
            'data' => $request->all(),
        ];

        $admins = User::where('admin', true)->pluck('email')->toArray();

        event(new OrderPlaced($order,$admins,$mailData));

        // Mail::to($admins)->queue(new OrderMail($mailData));

        Cart::clear();

        return redirect('/products')->with('status', 'Success! Order sent!');
    }
}
