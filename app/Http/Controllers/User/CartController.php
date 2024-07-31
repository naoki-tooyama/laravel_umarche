<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $totalPrice =0;

        foreach($products as $product){
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        // dd($products, $totalPrice);

        return view('user.cart', 
            compact('products', 'totalPrice'));
    }

    public function add(Request $request){
        // dd($request);
        $itemInCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)->first();//カートに商品があるか確認

        if($itemInCart){
            $itemInCart->quantity += $request->quantity;//同じ商品があれば数量追加
            $itemInCart->save();
        }else{
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('user.cart.index');
    }

    public function delete($id){
        Cart::where('product_id', $id)
            ->where('user_id', Auth::id())->delete();

            return redirect()->route('user.cart.index')
            ->with(['message' => '商品を削除しました。',
            'status' => 'alert']);
    }

    public function checkout(){
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        
        
        $lineItems = [];
        foreach($user->products as $product){
            $line_item =[
                'name' => $product->name,
                'description' => $product->description,
                'amount' => $product->price,
                'currency' => 'jpy',
                'quantity' => $product->pivot->quantity,
            ];
            array_push($lineItems, $line_item);
        }
// dd($lineItems, $line_item);
        // dd($products, $totalPrice);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel'),
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', 
            compact('session', 'publicKey'));
    }
}
