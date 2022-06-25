<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $data=Category::all();
        return view ('admin.category',['category'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_category(Request $r)
    {
        $data=new Category;

        $data->category=$r->category_name;
        $data->save();
        return redirect()->back()->with('add_cat','Category Added Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete_category(Category $id)
    {
       $id->delete();
       return redirect()->back()->with('del_cat','Category Deleted Successfully');

    }

   
    public function view_products()
    {
       $data=Category::all();
       return view ('admin.addproducts',['category'=>$data]);

    }
    public function add_products(Request $req)
    {
        
        $product=new product;

        $product->title=$req->title;
        $product->description=$req->description;
        $product->category_id=$req->category;
        $product->quantity=$req->quantity;
        $product->price=$req->price;
        $product->discount_price=$req->dis_price;

        $image=$req->image;
        $img_name=time().'.'.$image->getClientOriginalExtension();
        $req->image->move('product',$img_name);
        $product->image=$img_name;
        
        $product->save();
        return redirect()->back()->with('add_products','Product Added Successfully');


    }

    public function show_products()
        {
           // $product=DB::table('products')->join('categories','categories.id','=','products.category')->get();
            $product=product::join('categories','categories.cid','=','products.category_id')->get();
            return view ('admin.showproducts',['data'=>$product]);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_product(Product $id)
    {
       $id->delete();
       return redirect()->back()->with('del_product','Product Deleted Successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_product($id)
    {   

        $category=Category::all();
        // for edit data alaways use first because get() method return an multiple data array but first() will return only one data
         $data=DB::table('products')->join('categories','categories.cid','=','products.category_id')->where('products.id',$id)->first();
         
         return view('admin.editproduct',compact('data','category'));
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $req,$id)
    {
        $product=product::find($id);

        $product->title=$req->title;
        $product->description=$req->description;
        $product->category_id=$req->category;
        $product->quantity=$req->quantity;
        $product->price=$req->price;
        $product->discount_price=$req->dis_price;

        $image=$req->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $req->image->move('product',$imagename);
            $product->image=$imagename;
        }

        $product->save();
        return redirect('show-products')->with('up_product','Product Update Successfully');

    }
    public function customer(){
        $customer=User::where('userType','0')->get();
        return view('admin.customer',['customer'=>$customer]);
    }
     public function deleteUser(User $id){
        $id->delete();
        return redirect()->back();
    }
    public function delete_order($id){
        Order::where('id',$id)->delete();
        return redirect()->back()->with('status_delete','Product Delete From the Order');
    }
    public function delete_order_page($id){
        return $id;
    }
     public function notdelivered(){
        $data=Order::where('delivery_status','Not_Delivered')->get();
        return view('admin.notdelivered',['product'=>$data]);
    }
    public function shipping(){
        $data=Order::where('delivery_status','ship')->get();
        return view('admin.shipping',['product'=>$data]);
    }
    public function delivered(){
        $data=Order::where('delivery_status','Delivered')->get();
        return view('admin.delivered',['product'=>$data]);
    }
    public function toshipping($id){
        $data=Order::where('id',$id)->update(['delivery_status'=>'ship']);

        return redirect()->back()->with('status_up','Product On the Shipment');
    }
    public function todelivered($id){
        $data=Order::where('id',$id)->update(['delivery_status'=>'Delivered']);

        return redirect()->back()->with('status_todelivered','Product Delivered SuccessFully');
    }
   
   
}
