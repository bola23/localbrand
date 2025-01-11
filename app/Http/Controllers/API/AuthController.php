<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sellers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function index(){
        $users = User::all();
        return $this->sendResponse($users,'display all users data');
    } 
    
    
// For Customers Register
    public function register(Request $request){
        $Validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required|email',
            'password' => 'required'
        ]);
        if($Validator->fails()){
            return $this->sendError('Validation Error', $Validator->errors());
        }
         
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 1;
        $user = User::create($input);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['username'] = $user->name;
        return $this->sendResponse($success,'user Registered Successfully');
    }

    //  For Sellers Register
    public function SellerRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Unique for the users table
            'password' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required|numeric',
            'ID_NO' => 'required|unique:sellers,ID_NO', // Unique for the sellers table
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

            // Create the user
    $input = $request->only(['name', 'email', 'password','role']);
    $input['password'] = bcrypt($input['password']);
    $input['role'] = 2;
    $user = User::create($input);

        
    $seller = Sellers::create([
        'user_id' => $user->id,
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'phone' => $request->phone,
        'email' => $request->email,
        'ID_NO' => $request->ID_NO,  // Ensure that ID_NO is passed correctly
    ]);
    
        // Generate token for the user
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['username'] = $user->name;
    
        return $this->sendResponse($success, 'Seller registered successfully');
    }


    public function login(Request $request){
        
        if(Auth::attempt(['name'=>$request->name , 'password' => $request->password])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
            $success['username'] = $user->name;
            return $this->sendResponse($success,'user Logged in Successfully');
        }

        return $this->sendError('Unauthorised', ['error' => 'Unauthorised']);

    }
}


