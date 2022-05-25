<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;
use File;
use Validator;
use Notification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UsedCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AdminNotifications;
use App\Notifications\RegisterNotifications;

class UserController extends Controller
{
    use ResponseTrait;
    //

    public $successStatus = 200;
    public $successNodataStatus = 204;

    public function __construct(Request $request)
    {
    }

    //login

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->first());
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $data = [
                'token'  => $user->createToken('MyApp')->plainTextToken,
                'user-data' => new UserResource($user)
            ];
            return $this->returnData('user data', $data);
        }
        else{
                $message = trans('auth.failed');

            return response()->json(['message'=>$message], 401);
        }
    }

    //register

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:190',
            'last_name' => 'required|min:3|max:190',
            'email' => 'required|email:filter|unique:users',
            'password' => 'required|confirmed|min:6|required_with:password_confirmation',
            'password_confirmation' => 'min:6|same:password',
            // 'phone'=>'required|min:4|max:190|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['type'] ='user';
        $user = User::create($input);

        $admins = User::where('type','admin')->get();

        return response()->json(['message'=>trans('auth.messages.success_register'),'data'=>new UserResource($user)]);
    }


}
