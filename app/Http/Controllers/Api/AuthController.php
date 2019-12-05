<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Socialite;
use Hash;
use App\SocialFacebookAccount;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function logout()
    {
        try {
            $customer = auth('api')->user();
            if ($customer) {
                $cookie = cookie('token', null, 20);
            }
            auth('api')->logout();
            return response()->json(['success' => true, 'message' => 'successful'], 200)->cookie($cookie);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }

    public function me()
    {
        $customer = auth('api')->user();
        $customer->setHidden(['apn_token', 'password']);

        return response()->json($customer, 200);
    }

    public function facebook(Request $request)
    {
        try {
            $customerSocial = Socialite::driver('facebook')->customerFromToken($request->access_token);

            return $this->socialLogin($customerSocial);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }
    public function google(Request $request)
    {

        try {
            $customerSocial = SocialFacebookAccount::whereProvider('google')
                ->whereProviderUserId($request->customer_id)
                ->first();
            return $this->socialLogin($customerSocial);
        } catch (\GuzzleHttp\Exception\ClientException $ex) {

            $content = file_get_contents("https://oauth2.googleapis.com/tokeninfo?id_token=" . $request->access_token);
            $customerSocial = json_decode($content);

            if ($customerSocial->aud == env('GOOGLE_MOBILE_KEY')) {
                return $this->socialLogin($customerSocial);
            }
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 422);
        }
    }
    public function googleLogin(Request $request)
    {
        $customerSocial = SocialFacebookAccount::whereProvider('google')
            ->whereProviderUserId($request->id)
            ->first();
        
        if ($customerSocial) {
            $customer = customer::where('id', $customerSocial->customer_id)->first();
        } else {
            
            $account = new SocialFacebookAccount([
                'provider_user_id' => $request->id,
                'provider' => 'google'
            ]);

            $customer = customer::create([
                'email' => $request->email,
                'password' =>  md5(rand(1, 10000)),
                'name' => $request->name,
                'phone' => '',
            ]);

            $account->customer()->associate($customer);
            $account->save();
        }

        try {
            if (!$token = auth('api')->login($customer)) {
                return response()->json(["success" => false, "message" => 'invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(["success" => false, "message" => 'failed_to_create_token'], 500);
        }

        $customer = auth('api')->user();
        $customer->setHidden(['password']);

        $cookie = cookie('token', $token, 3600);

        return response()->json(compact('token', 'customer'))->cookie($cookie);
        return response()->json(["success" => false, "message" => 'failed_to_create_token'], 500);
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $token = null;

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(["success" => false, "message" => 'invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(["success" => false, "message" => 'failed_to_create_token'], 500);
        }
        $customer = auth('api')->user();
        $customer->setHidden(['password']);

        $cookie = cookie('token', $token, 3600);

        return response()->json(compact('token', 'customer'))->cookie($cookie);
    }
    public function register(Request $request)
    {

        if (filter_var($request->email, FILTER_VALIDATE_EMAIL) && $request->password) {
            $customer = Customer::where('email', $request->email)->first();
            if ($customer) {
                return response()->json(['success' => false, 'message' => 'email already in use'], 422);
            }

            $customer = Customer::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name ?? '',
                'phone' => $request->phone ?? '',
                'address' => $request->address ?? '',
                'birthday' => $request->birthday ?? '',
            ]);

            if ($customer) {
                try {
                    if (!$token = auth('api')->login($customer)) {
                        return response()->json(["success" => false, "message" => 'invalid_email_or_password'], 422);
                    }
                    $customer = auth('api')->user();
                    $customer->setHidden(['password']);

                    $cookie = cookie('token', $token, 3600);

                    return response()->json(compact('token', 'customer'))->cookie($cookie);
                } catch (JWTAuthException $e) {
                    return response()->json(["success" => false, "message" => 'failed_to_create_token'], 500);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'fail to create account'], 422);
            }
        }
        return response()->json(['success' => false, 'message' => 'missing email or password'], 422);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
