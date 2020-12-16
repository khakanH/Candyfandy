<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Orders;
use App\Models\OrderDetails;

use DB;

class OrderController extends Controller
{

    public function __construct(Request $request)
    {   
    }



    public function Index(Request $request)
    {	
        $user_id = session("login.user_id");

        $user_info = $this->checkUserAvailbility($user_id,$request);

        $orders = Orders::where('order_status',1)->orderBy('created_at','asc')->get();

        // foreach ($orders as $key)
        // {
        //     foreach($key->order_details as $key_)
        //     {
        //         echo $key_;
        //     }
        // }
        // exit();
        return view('order',compact('orders'));
    }















    public function checkUserAvailbility($id,$request)
    {   

       
        $user = Admin::where('id',$id)->where('is_blocked',0)->first();


        if ($user == "") 
        {   

            if($request->ajax()) 
            {
                return response()->json(['status'=>"0",'msg' => 'Session expired'],401);
            }
            else
            {
                $request->session()->put("failed","Something went wrong.");
                header('Location:'.url('signout'));
            }
            
            exit();
        }
        else
        {   
            return $user;
        }
    }
    


}
    