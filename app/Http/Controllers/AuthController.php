<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function signup( Request $request ) {

        $input = $request->all();

        $validator = Validator::make($input, [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if($validator->fails()) {
            return $this->sendError("signup fail", $validator->errors());
        }

        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);

        return $this->sendResponse( $user, "signup OK");
    }

    public function login( Request $request ) {

        if(Auth::attempt([ 
            "email" => $request->email, 
            "password" => $request->password 
        ])) {
            $authUser = Auth::user();
            $success["token"] = 
                $authUser->createToken("myauthapp")->plainTextToken;
            $success["name"] = $authUser->name;

            return $this->sendResponse( $success, "hello");
        } else {
            return $this->sendError("login fail", [ "error" => "sikertelen"]);
        }
    }

    public function logout (Request $request) {

        auth("sanctum")->user()->currentAccessToken()->delete();

        return response()->json("logout OK");
    }
}
