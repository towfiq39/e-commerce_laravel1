<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;
class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){
            return redirect('redirect');
        }else{
            $category_data=Category::all();
            $product=product::paginate(6);
            return view('home.index',['data'=>$product , 'category'=>$category_data]);
        }
    	
    } 
    public function redirect(){
    	$userType=Auth::user()->userType;

        $products=Product::all()->count();
        $totalorders=Order::all()->count();
        $customer=User::where('userType','0')->count();
        $order_shipment=Order::where('delivery_status','ship')->count();
        $order_delivered=Order::where('delivery_status','Delivered')->count();

        $order=Order::all();
        $totalRevenue=0;
        foreach ($order as $order) {
            $totalRevenue=$totalRevenue + ($order->product_quantity * $order->product_price) ;
        }

    	if($userType=='1'){
    		return view ('admin.home',["product"=>$products,"orders"=>$totalorders,"customers"=>$customer,"shipment"=>$order_shipment,"delivered"=>$order_delivered,"Revenue"=>$totalRevenue]);
    	}else{
            $category_data=Category::all();
            $product=product::paginate(6);
            $count_product=Cart::where('user_id',Auth::id())->count();
            return view('home.index',['data'=>$product,'count'=>$count_product , 'category'=>$category_data]);
    	}
    }
    public function product_details($id){
        $single_product=product::join('categories','categories.cid','=','products.category_id')->where('products.id',$id)->first();
        $category_data=Category::all();
        $cat_id=$single_product->cid;
        $count_product=Cart::where('user_id',Auth::id())->count();
        $cat_product=product::join('categories','categories.cid','=','products.category_id')->where('categories.cid',$cat_id)->get();
        return view('home.productdetails',['data'=>$cat_product,'sdata'=>$single_product,'count'=>$count_product ,'category'=>$category_data]);
            
        //return view('home.productdetails');
    }
    public function add_cart(Request $req , $id){
        if(Auth::id()){
            $user=Auth::user();
            $product=product::find($id);
            $cartData=Cart::where('user_id',$user->id)->where('product_id',$product->id)->first();
           if($cartData){
                $cart=Cart::where('user_id',$user->id)->where('product_id',$product->id)->update(['product_quantity'=>$req->quantity] );

            }else{
            $cart=new Cart;

                 $cart->user_id=$user->id;
                 $cart->user_name=$user->name;
                 $cart->user_email=$user->email;
                 $cart->user_phone=$user->phone;
                 $cart->user_address=$user->address;
                 $cart->product_id=$product->id;
                 $cart->product_title=$product->title;
                 $cart->product_quantity=$req->quantity;

                 
                 

                 if($product->discount_price!=null){
                     $cart->product_price=$product->discount_price;
                 }else{
                     $cart->product_price=$product->price;
                 }
                 
                $cart->product_image=$product->image;

                $cart->save();
           }
            
                return redirect()->back()->with('add_cart','Product Added To Cart Successfully');
            
        }else{
            return redirect ('login');
        }
    }
    public function search_product(Request $r)
    {
        $search = $r->search_product;
        $category_data=Category::all();
        $count_product=Cart::where('user_id',Auth::id())->count();
         
        if($search==''){
            $productData=Product::paginate(6);
            return view('home.index',['data'=>$productData,'category'=>$category_data,'count'=>$count_product]);
        }
        
        $searchdata= Product::where('title','Like','%'.$search.'%')->get();
        return view('home.index',['data'=>$searchdata,'category'=>$category_data,'count'=>$count_product]);
    }
    public function category_product($id){
         $count_product=Cart::where('user_id',Auth::id())->count();
            
        $category_data=Category::all();
        $cat=Product::join('categories','categories.cid','=','products.category_id')->where('categories.cid',$id)->get();
        return view('home.category_product',['category'=>$category_data ,'data'=>$cat,'count'=>$count_product]);
    }
    public function show_cart(){
        if(Auth::id()){
            $category_data=Category::all();
            $user=Auth::user();
            $count_product=Cart::where('user_id',Auth::id())->count();
            $cartData=Cart::where('user_id',Auth::id())->get();

            $data=Cart::where('user_id',$user->id)->get();
            

            return view ('home.showcart',['count'=>$count_product,'category'=>$category_data,'data'=>$cartData]);
        }else{
            redirect('login');
        }
    }
    public function remove_cart($id){
        
       $userid=Auth::id();
       Cart::where('user_id',$userid)->where('product_id',$id)->delete();
       return redirect()->back()->with('cart-delete','Deleted Data from This cart');
        

    }
     public function order(Request $req){

            $user=Auth::user();
            $data=Cart::where('user_id',$user->id)->get();
            Session::put('name',$req->customer_name);
            Session::put('number',$req->customer_mobile);
            Session::put('street',$req->street);
            Session::put('address',$req->address);
            Session::put('email',$user->email);

            $total=0;
            foreach ($data as $info) {
                $total=$total + $info->product_price * $info->product_quantity  +10;
            }

           if($req->payment_method=="COD"){

                $totalprice=0;
                foreach ($data as $info) {

                
                $order=new order;
                $product=product::find($info->product_id);
                
                

                $order->name=Session::get('name');
                $order->email=Session::get('email');
                $order->phone=  Session::get('number') ;
                $order->street=Session::get('street');
                $order->address=Session::get('address');
                $order->amount=$total;
                $order->product_id=$info->product_id;
                $order->product_name=$info->product_title;
                $order->product_price=$info->product_price;
                $order->product_quantity=$info->product_quantity;
                $order->status="COD";
                $order->delivery_status="Not Delivered";
                $order->Currency="BDT";
                $order->save();
                $data=product::where('id',$info->product_id)
                    ->update(['quantity'=>$product->quantity - $info->product_quantity]);
                $totalprice=$totalprice + ($info->product_price* $info->product_quantity);
                }


                $cartData=Cart::where('user_id',$user->id)->delete();
                return redirect('redirect')->with('order','Thanks for Product ordered.');

            }else if($req->payment_method=="ssl"){

                $user=Auth::user();
                $cartData=Cart::where('user_id',Auth::id())->get();
               

                return view('home.exampleHosted',['cartData'=>$cartData]);
            }
            else{
               $totalprice=0;
                foreach ($data as $info) {
                    $totalprice=$totalprice + $info->product_price * $info->product_quantity  +10;
                }
               return view("home.stripe",["price"=>$totalprice]);
            }
        
       
    }
    public function plusqty($id){

        $data=Cart::where('product_id',$id)->where('user_id',Auth::id())->first();
        Cart::where('product_id',$id)->where('user_id',Auth::id())->update(['product_quantity'=>$data->product_quantity + 1]);
        return redirect()->back()->with('upqty','Quantity Updated Successfully');

    }
    public function minusqty($id){
        $data=Cart::where('product_id',$id)->where('user_id',Auth::id())->first();
        if($data->product_quantity <= 1){
            $userid=Auth::id();
            Cart::where('user_id',$userid)->where('product_id',$id)->delete();
            return redirect()->back()->with('cart-delete','Deleted Data from This cart');
        }else{
            Cart::where('product_id',$id)->where('user_id',Auth::id())->update(['product_quantity'=>$data->product_quantity - 1]);
            return redirect()->back()->with('upqty','Quantity Updated Successfully');
        }
    }
    public function checkout(){
        $category_data=Category::all();
        $user=Auth::user();
        $count_product=Cart::where('user_id',Auth::id())->count();
        $cartData=Cart::where('user_id',Auth::id())->get();
        return view ('home.checkout',['count'=>$count_product,'data'=>$cartData,'category'=>$category_data,'user'=>$user]);
    }

    public function stripePost(Request $req,$price)
       {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       
            Stripe\Charge::create ([
                   "amount" => $price * 100,
                   "currency" => "usd",
                   "source" => $req->stripeToken,
                   "description" => "Thanks for Payment." 
            ]);
            $user=Auth::user();
            $data=Cart::where('user_id',$user->id)->get();
            
            foreach ($data as $info) {

                
            $order=new order;
            $product=product::find($info->product_id);
            

            $order->name=Session::get('name');
            $order->email=Session::get('email');
            $order->phone=  Session::get('number') ;
            $order->street=Session::get('street');
            $order->address=Session::get('address');
            $order->amount=$price;
            $order->product_id=$info->product_id;
            $order->product_name=$info->product_title;
            $order->product_price=$info->product_price;
            $order->product_quantity=$info->product_quantity;
            $order->status="PAID";
            $order->delivery_status="Not_Delivered";
            $order->Currency="BDT";


            $order->save();
            $data=product::where('id',$info->product_id)
                ->update(['quantity'=>$product->quantity - $info->product_quantity]);
            }

            $cartData=Cart::where('user_id',$user->id)->delete();
            return redirect('redirect')->with('order','Thanks for Product ordered.');
       }
   
    public function test(Request $r){
        return $r;
    }
}
