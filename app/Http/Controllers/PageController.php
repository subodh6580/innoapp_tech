<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_item;
//use App\Models\Activity;
use \Spatie\Activitylog\Models\Activity;
use DataTables;
use Bouncer;
use Auth;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Yajra\DataTables\DataTables
     */
    public function CustomersDatatable(Request $request)
    {
        if(Self::IsShopManager()){
            return redirect()->back()->with('message', 'Permission denied!');
        }
        if ($request->ajax()) {
            $users = Customer::select(["name", "email", "created_at"])->get();
            activity()->withProperties($users)->log('All Customers');
            return datatables($users)
            ->editColumn('created_at', function ($user) {
            return $user->created_at->format('d/m/Y');
            })
            ->make(true);
            
        }
        activity()->log('Customers listings');
        $data['title'] = 'Customers';
     
        return view('user',$data);
    }

    /**
     * Show all products.
     *
     * @return \Yajra\DataTables\DataTables
     */
    public function ProductsDatatable(Request $request)
    {
        if(Self::IsUserManager()){
            return redirect()->back()->with('message', 'Permission denied!');
        }
        if ($request->ajax()) {
            $products = Product::select(["id","name", "stock_status","price","created_at"])->get();
            activity()->withProperties($products)->log('All Products');
            return datatables($products)
            ->editColumn('created_at', function ($products) {
            return $products->created_at->format('d/m/Y');
            })
           ->editColumn('stock_status', function ($products) {
                 if($products->stock_status == 'in_stock')
                 {
                    return 'In Stock';
                      
                } else {
                    return  'Out of Stock';
                 }
                }) 
                ->addColumn('action', function ($products) {
                    $html = '<a href="#" onclick="getProductID(id)" id="'.$products->id.'" class="btn btn-xs btn-secondary">Change Stock</a> ';
                    return $html;
                })
                ->toJson();
        }
        $data['title'] = 'Products';
        activity()->log('Product listings');
        return view('product',$data);
    }

    /**
     * Show all orders.
     *
     * @return \Yajra\DataTables\DataTables
     */
    public function OrdersDatatable(Request $request)
    {
        if(Self::IsUserManager()){
            return redirect()->back()->with('message', 'Permission denied!');
        }
        
            
        if ($request->ajax()) {
            $orders = Order::get();
            $customer=[];
            foreach($orders as $key=>$d){
                $orders[$key]['customer_id'] = $d->customer->name;
            }
           
            activity()->withProperties($orders)->log('All Orders');
            return datatables($orders)
            ->editColumn('created_at', function ($orders) {
            return $orders->created_at->format('d/m/Y');
            })
            ->editColumn('status', function ($orders) {
                 if($orders->status == 'new')
                 {
                    return 'New';
                 } else {
                    return  'Processed';
                 }
                })
                
                ->addColumn('action', function ($orders) {
                    $html = '<a href="/order_details/'.$orders->id.'" target="_blank" id="'.$orders->id.'" class="btn btn-xs btn-secondary">View</a> ';
                    return $html;
                })
                ->toJson();
        }
        $data['title'] = 'Orders';
        
        activity()->log('Order listings');
        return view('order',$data);
    }

    public function IsAdmin()
    {
        return true;
    }

    public function IsShopManager()
    {
        return Bouncer::can('shop-manager');
    }

    public function IsUserManager()
    {
        return Bouncer::can('user-manager');
    }

    public function ChangeStock($id)
    {
        $products = Product::select('*')->where('id',$id)->first();
        if($products->stock_status == 'in_stock')
        { 
            activity()->log('Product Stock');
            $products->stock_status = 'out_of_stock';
            $products->save();
            return true;
        } else {
            activity()->log('Product Stock');
            $products->stock_status = 'in_stock';
            $products->save();
            return true;
        }
        
    }

    public function OrderDetails($id)
    { 
        if(Self::IsUserManager()){
            return redirect('customers')->with('message', 'Permission denied!');
        }
        $details = Order_item::where('order_id',$id)->get();
      
        foreach($details as $k=>$d){
            $details[$k]['customer_name'] = $d->order->customer->name;
            $details[$k]['invoice_number'] = $d->order->invoice_number;
            $details[$k]['product_name'] = $d->product->name;
            $details[$k]['price'] = $d->product->price;
        }
        $data['orderDetails'] = $details;
        $data['title'] = 'Order Details';
        if(!empty($details[0]->invoice_number))
        {
            activity()->log(Auth::id().' logged in '.Auth::user()->name.'  processed the order:'.$details[0]->invoice_number.'');
        }
        return view('order_details',$data);
    }
}
