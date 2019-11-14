<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Token;
use App\Includes\Helpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // register
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'username'                  => 'required',
            'email'                     => 'required|unique:clients|max:255',
            'date_of_birth'             => 'required',
            'blood_type_id'             => 'required',
            'last_donation'             => 'required',
            'city_id'                   => 'required',
            'phone'                     => 'required|unique:clients',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $client = new Client();
        $client->fill($request->all());
        $client->password  = bcrypt(Request('password'));
        $client->api_token = str_random(60);
        $client->save();

        return Helpers::responseJson(1, 'تم التسجيل بنجاح', [
            'api_token' => $client->api_token,
            'client'    => $client
        ]);

    }

    // login
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'phone'      => 'required',
            'password'   => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        if($client) {

            if(Hash::check($request->password, $client->password)) {

                return Helpers::responseJson(1, 'تم تسجيل الدخول', [
                    'api_token' => $client->api_token,
                    'client'    => $client
                ]);
            } else {
                return Helpers::responseJson(0, 'بيانات الادخال غير صحيحه');
            }

        } else {
            return Helpers::responseJson(0, 'لا يوجد حساب مرتبط برقم التليفون الذي ادخلته');
        }
    }

    // reset Password

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone'  => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        if($client) {
            $code = rand(111,9999);
            $update = $client->update(['pin_code' => $code]);

            if($update) {

                Mail::to($client->email)
                    ->bcc("emad.elfoly99@gmail.com")//copy message to my account
                    ->send(new ResetPassword($code));
                return Helpers::responseJson(1, 'رجاء قم بفحص هاتفك',['pin_code_for_reset' => $code]);

            } else {
                return Helpers::responseJson(0, 'حدث خطأ حاول مره اخرى');
            }

        } else {
            return Helpers::responseJson(0, 'لا يوجد حساب مرتبط برقم التليفون الذي ادخلته');
        }

    }

    // new Password

    public function newPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone'                     => 'required',
            'pin_code'                  => 'required',
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        if($client) {

            if($client->pin_code == $request->pin_code) {

                $client->pin_code = null;
                $client->password = bcrypt(Request('password'));
                $client->save();
                return Helpers::responseJson(1, 'نم تغير الباسورد بنجاح');

            }else{
                return Helpers::responseJson(0, 'رقم بن كود خطأ');
            }


        } else {
            return Helpers::responseJson(0, 'لا يوجد حساب مرتبط برقم التليفون الذي ادخلته');
        }
    }
    // show profile

    public function profile() {

        $client = Client::find(auth()->user()->id);

        return Helpers::responseJson(1, 'success', $client);
    }

    // update profile

    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'username'                  => 'required',
            'email'                     => [
                                            'required',
                                            'email',
                                            Rule::unique('clients', 'email')->ignore(auth()->user()->id)
                                            ],
            'date_of_birth'             => 'required',
            'blood_type_id'             => 'required',
            'last_donation'             => 'required',
            'city_id'                   => 'required',
            'phone'                     => [
                                            'required',
                                            Rule::unique('clients', 'phone')->ignore(auth()->user()->id)
                                            ],
            'password'                  => 'nullable|confirmed',
            'password_confirmation'     => 'nullable',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $client = Client::find(auth()->user()->id);

        $past_pass  = $client->password;
        $client->fill($request->all());

        if(Request('password')) {
            $client->password     = bcrypt(Request('password'));
        }else{
            $client->password = $past_pass;
        }
        $client->save();

        return Helpers::responseJson(1, 'تم التعديل بنجاح', $client);

    }

    // register Token

    public function registerToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,ios',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $token = Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return Helpers::responseJson(1, 'تم التسجيل بنجاح');
    }

    // remove Token

    public function removeToken(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()) {
            return Helpers::responseJson(0, 'validator error', $validator->errors());
        }

        $token = Token::where('token',$request->token)->delete();

        return Helpers::responseJson(1, 'تم التسجيل الخروج والحذف بنجاح');
    }

    //logout

    public function logout() {
        Auth::guard('api')->logout();
        return Helpers::responseJson(1, 'تم تسجيل الخروج');
    }
}
