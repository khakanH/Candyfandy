<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\UserType;

use DB;

class UserController extends Controller
{

    public function __construct(Request $request)
    {   
    }



    public function Index(Request $request)
    {	 
        try 
        {
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
           
            return view('user');
        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }

    }

    public function AddUpdateUser(Request $request)
    {
        try 
        {   
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
            
            $input = $request->all();


            if(Admin::where('name',strtolower(trim($input['user_name'])))->count() > 0)
            {
                return array("status"=>"0","msg"=>"User Name Already Exist.");
            }

            
             

            if (empty($input['user_id'])) 
            {   
                $data = array(
                        "name"                  => strtolower(trim($input['user_name'])),
                        "email"                 => strtolower(trim($input['user_email'])),
                        "password"              => Hash::make('12345'),
                        "user_type"             => $input['user_type'],
                        "is_blocked"            => 0,
                        "created_at"            => date('Y-m-d H:i:s'),
                        "updated_at"            => date('Y-m-d H:i:s'),
                        );
                if(Admin::insert($data))
                {
                    return array("status"=>"1","msg"=>"User Added Successfully.");
                }
                else
                {
                    return array("status"=>"0","msg"=>"Failed To Add User");

                }
            }
            else
            {
                $data = array(
                        "user_type"             => $input['user_type'],
                        "updated_at"            => date('Y-m-d H:i:s'),
                        );
                if(Admin::where('id',$input['user_id'])->update($data))
                {
                    return array("status"=>"1","msg"=>"User Updated Successfully.");
                }
                else
                {
                    return array("status"=>"0","msg"=>"Failed To Update User");
                }


            }


           
            
        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }
    }


    public function UserTypeNameList(Request $request,$type)
    {

        try 
        {   
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
            

                 
            $get_user_type_list = UserType::get();
           
            
            if (count($get_user_type_list)==0) 
            {
                ?>
                <option value="" disabled="" selected="">Select User Type</option>
                <?php
            }
            else
            {

                foreach ($get_user_type_list as $key) 
                {
                ?>

                <option   
                        <?php if ((int)$type== $key['id']): ?>
                            selected
                        <?php endif ?>
                 value="<?php echo $key['id'] ?>"><?php echo $key['name'] ?></option>
                    

                <?php
                } 
            }

        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }
    }


    // ----------------------------------------------------------------------------------------------
    // ----------------------------------------------------------------------------------------------
    // ----------------------------------------------------------------------------------------------


    public function UserType(Request $request)
    {    
        try 
        {
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
           
            $user_type = UserType::get();
           
            return view('usertype',compact('user_type'));
        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }
    }

    public function AddUpdateUserType(Request $request)
    {
        try 
        {   
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
            
            $input = $request->all();


            if(UserType::where('name',strtolower(trim($input['user_type_name'])))->count() > 0)
            {
                return array("status"=>"0","msg"=>"User Type Name Already Exist.");
            }

            
             

            if (empty($input['user_type_id'])) 
            {   
                $data = array(
                        "name"                  => strtolower(trim($input['user_type_name'])),
                        "created_at"            => date('Y-m-d H:i:s'),
                        "updated_at"            => date('Y-m-d H:i:s'),
                        );
                if(UserType::insert($data))
                {
                    return array("status"=>"1","msg"=>"User Type Added Successfully.");
                }
                else
                {
                    return array("status"=>"0","msg"=>"Failed");

                }
            }
            else
            {
                $data = array(
                        "name"                  => strtolower(trim($input['user_type_name'])),
                        "updated_at"            => date('Y-m-d H:i:s'),
                        );
                if(UserType::where('id',$input['user_type_id'])->update($data))
                {
                    return array("status"=>"1","msg"=>"User Type Updated Successfully.");
                }
                else
                {
                    return array("status"=>"0","msg"=>"Failed");
                }


            }


           
            
        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }
    }

    public function UserTypeListAJAX(Request $request)
    {
        try 
        {   
            $user_id = session("login")["user_id"];

            $user_info = $this->checkUserAvailbility($user_id,$request);
            

                 $get_user_type_list = UserType::get();
           
            
            if (count($get_user_type_list)==0) 
            {
                ?>
                <tr><td colspan="3" class="text-center tx-18">No User Type Found</td></tr>
                <?php
            }
            else
            {

                $count= 1;
                foreach ($get_user_type_list as $key) 
                {
                ?>

                    <tr id="usertype<?php echo $key['id']?>">
                      <td scope="row"><b><?php echo $count; ?></b></td>
                      <td><?php echo $key['name']?></td>
                      <td><a class="btn btn-primary" href="javascript:void(0)" onclick='EditUserType("<?php echo $key['id']?>","<?php echo $key['name']?>")'><i class="fa fa-edit tx-15"></i></a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" onclick='DeleteUserType("<?php echo $key['id'] ?>")' href="javascript:void(0)"><i class="fa fa-trash tx-15"></i></a></td>
                    </tr>

                <?php
                $count++;
                } 
            }

        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
        }
    }


    public function DeleteUserType(Request $request,$id)
    {
        try 
        {
            $user_id = session("login.user_id");

            $user_info = $this->checkUserAvailbility($user_id,$request);

            if(UserType::where('id',$id)->delete())
            {
                return array("status"=>"1","msg"=>"User Type Deleted Successfully.");
            }
            else
            {
                return array("status"=>"0","msg"=>"Failed to Delete User Type.");
            }
        } 
        catch (Exception $e) 
        {
            return response()->json($e,500);
            
        }
    }


    // ----------------------------------------------------------------------------------------------
    // ----------------------------------------------------------------------------------------------
    // ----------------------------------------------------------------------------------------------














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
    