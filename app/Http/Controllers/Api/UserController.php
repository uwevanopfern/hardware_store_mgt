<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => [
                // the standard "email" rule
                'Email',
                // custom validation rule (using closures)
                function ($attribute, $value, $fail) {
                    // split the string at every "."
                    $exploded = explode('.', $value);
                    // check if the last item matches "fr" or "com"
                    if (!in_array(end($exploded), ['fr', 'com', 'net', 'org'])) {
                        $fail($attribute . ' format is invalid.');
                    }
                }
                , 'string', 'email', 'max:255', 'unique:users'

            ],
            'phone' => 'required|regex:/^([0-9\s\(\)]*)$/|min:7|max:15|unique:users',
            'company_id' => 'required',
            'password' => 'required|min:8|confirmed',
            'agreed_to_terms' => 'required|integer',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'company_id' => $validatedData['company_id'],
            'agreed_to_terms' => $validatedData['agreed_to_terms'],
            'password' => Hash::make($validatedData['password']),
        ]);
        $accessToken = $user->createToken('authToken')->accessToken;
        $tokenResult = $user->createToken('Personal Access Token');

        //send email verification
//        $user->sendEmailVerificationNotification();

        return response([
            'user' => new UserResource($user),
            'token' => $accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()

        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Login user and create token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse [string] access_token
     * @internal param $ [string] email
     * @internal param $ [string] password
     * @internal param $ [boolean] remember_me
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        //Check if user exists
        if (!Auth::guard('web')->attempt($validated))
            return response()->json([
                'error' => true,
                'message' => 'Invalid credentials, Try again!'], Response::HTTP_UNAUTHORIZED);

        $user = $request->user();
        //Check if user verified email
        if ($user->email_verified_at == NULL) {

            return response()->json([
                'error' => true,
                'message' => 'Please Verify Email',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'token_type' => 'Bearer',
            'murugo_user' => new UserResource(Auth()->User()),
            'murugo_access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ], Response::HTTP_OK);
    }

    /**
     * Logout user (Revoke the token)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['message' => 'Successfully logged out'], Response::HTTP_OK);
    }

    /**
     * Get the authenticated User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse [json] user object
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
