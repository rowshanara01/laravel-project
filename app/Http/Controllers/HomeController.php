<?php

namespace App\Http\Controllers;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

use Dom\Attr;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use function Laravel\Prompts\form;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
   public function index(){

    $user = User::where('userType','user')->get()->count();
    $product= Product::all()->count();
    $order = Order::all()->count();
    $delivered = Order::where('status','delivered')->get()->count();
     return view('admin.index',compact('user','product','order','delivered'));
   }

   public function home(){
    $products =Product::all();
    if(Auth::id()){
      $user = Auth::user();
    $userId =  $user->id;
    
    $count = Cart::where('user_id',$userId)->count();
    }else{
      $count = '';
    }
    return view('home.index',compact('products','count'));
   }

   public  function login_home(){
<<<<<<< HEAD
    $products= Product::all();
=======
    $products= Product::all();                                                 
>>>>>>> 99ac388 (Update code with latest changes)
    if(Auth::id()){
      $user = Auth::user();
    $userId =  $user->id;
    
    $count = Cart::where('user_id',$userId)->count();
    }else{
      $count = '';
    }
    return view('home.index',compact('products','count'));
   }

   public function product_details($id){
    $data = Product::find($id);
    if(Auth::id()){
      $user = Auth::user();
      $userId =  $user->id;
    
    $count = Cart::where('user_id',$userId)->count();
    }else{
      $count = '';
    }
    return view('home.product_details',compact('data','count'));
   }

   public function add_cart($id){
     $product_id = $id;
     $user = Auth::user();
     $user_id = $user->id;
     $data = new Cart();
     $data->user_id = $user_id;
     $data->product_id =  $product_id;

     $data-> save();
     toastr()->closeButton()->addSuccess('Cart added successfully');
     return redirect()->back();
   }

   public function myCart(){
    if(Auth::id()){
      $user = Auth::user();
    $userId =  $user->id;
    
    $count = Cart::where('user_id',$userId)->count();
    $cart = Cart::where('user_id', $userId)->get();
    }
    return view('home.cart',compact('count','cart'));
   }

   public function delete_cart($id){
       $data = Cart::find($id);
       $data->delete();
        toastr()->closeButton()->addSuccess('product Remove deleted form the Cart successfully');
        return redirect()->back();
   }

   public function confirm_order(Request $request){
    $name= $request->name;
    $address= $request->address;
    $phone= $request->phone;

    $user_id = Auth::user()->id;

    $cart = Cart::where('user_id',  $user_id )->get();

    foreach($cart as $carts ){
     $order = new Order();
     $order->name=  $name;
     $order->	rec_address= $address;
     $order->phone= $phone;
     $order->user_id= $user_id;
     $order->product_id=$carts->product_id;
     $order->save();
     

    }

    $cart_remove = Cart::where('user_id', $user_id )->get();
    foreach($cart_remove as $remove){
       $data = Cart::find($remove->id);
       $data->delete();
    }

    toastr()->closeButton()->addSuccess('product  Order successfully');
    return redirect()->back();
    
    }

    public function myOrders(){

      $user = Auth::user()->id;
      $count = Cart::where('user_id', $user)->get()->count();
      $order = Order::where('user_id', $user)->get();
      return view('home.order', compact('count','order'));
    }
     
      public function stripe($value)
    {
        return view('home.stripe',compact('value'));
    }
   public function stripePost(Request $request,$value)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

    $paymentIntent = PaymentIntent::create([
        'amount' => $value, // টাকা (পয়সায়, যেমন ১০ টাকা = ১০০০)
        'currency' => 'usd',
        'payment_method_types' => ['card'],
    ]);

    return response()->json([
        'success' => true,
        'payment_intent' => $paymentIntent->toArray()
    ]);
    }
    
  }