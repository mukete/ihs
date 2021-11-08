<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data['title'] = trans('manager.users');
        $data['users'] = \App\User::paginate(10);
        return view("manager.users.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $data['title'] = trans('manager.add_new_user');
        return view("manager.users.create")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',

        ]);


        $user = new \App\User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->company_id = auth()->user()->company_id;
        $user->password = \Hash::make($request->input('email'));
        $user->save();


        // send email to user 

        $details = [
                "company" => $user->company->name,
                "name"=> $user->name,
                "email" => $user->email,
                "password" => $user->password,
                "link" => url('settings'),
                "userType" => "USER"
            ];

        \Mail::to($request->user())
    ->send(new \App\Mail\SendEmailWelcome($details));

        return redirect()->to('manager/users')->with('s', trans('user_created'));

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

        $data['title'] = trans('manager.users');
        $data['user'] = \App\User::find($id);
        return view("manager.users.show")->with($data);
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

        $data['title'] = trans('manager.add_new_user');
        $data['user'] = \App\User::find($id);
        return view("manager.users.edit")->with($data);
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',

        ]);


        $user =  \App\User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = \Hash::make($request->input('email'));
        $user->save();

        return redirect()->back()->with('s', 'User updated ');
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
}
