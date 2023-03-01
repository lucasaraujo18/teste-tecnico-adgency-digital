<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use App\Modules\User\Services\CreateUserService;
use App\Modules\VerifyEmails\Services\VerifyEmailService;


class UserController extends Controller
{
    protected $createUserService;
    protected $user;
    protected $verifyEmailService;

    public function __construct(User $user, CreateUserService $createUserService, VerifyEmailService $verifyEmailService)
    {
        $this->user = $user;
        $this->createUserService = $createUserService;
        $this->verifyEmailService = $verifyEmailService;
    }
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
        $response = $this->createUserService->createUser();
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->createUserService->storeUser($request);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* Method that verifyAccount with a confirmation code*/
    public function verifyAccount(Request $request)
    {
        $response = $this->verifyEmailService->verifyCode($request);
        return $response;
    }
}
