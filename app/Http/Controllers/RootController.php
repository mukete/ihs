<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RootController extends Controller
{
    //

    public function companies(){

        $data['title'] = "";
        $data['companies'] = \App\Company::paginate(12);

        return view('root.companies.index')->with($data);
    }

     public function addCompany(){

        $data['title'] = "";

        return view('root.companies.create')->with($data);
    }

    public function saveCompany(Request $request){

        $this->validate($request, ['name'=> 'required',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email|unique:users',
            // 'manager' => 'required'
        ]);
        // return $request->all();


        $company = new \App\Company();
        $company->name = $request->input('name');
        $company->save();

        // create new user 



        $user = new \App\User();
        $user->name = $request->input('first_name')." ".$request->input('last_name');

  

        $user->email = $request->input('email');
        $user->type = "manager";
        $user->company_id = $company->id;
        $user->password = \Hash::make($request->input('email'));
        $user->save();



        // send email to user 

        $details = [
                "company" => $company->name,
                "name"=> $user->name,
                "email" => $user->email,
                "password" => $user->password,
                "link" => url('settings'),
                "userType" => "MANAGER"
            ];

        \Mail::to($request->user())
    ->send(new \App\Mail\SendEmailWelcome($details));

        return redirect()->to('root/users')->with('s','User was created');

    }


    public function departments(){

        $data['title'] = "";
        $data['departments'] = \App\Department::paginate(12);

        return view('root.departments.index')->with($data);
    }

    public function categories(){

        $data['title'] = "";
        $data['categories'] = \App\Category::paginate(12);

        return view('root.categories.index')->with($data);
    }

    public function courses(){

        $data['title'] = "";
        $data['courses'] = \App\Course::paginate(12);

        return view('root.courses.index')->with($data);
    }

    public function users(){

        $data['title'] = "";
        $data['users'] = \App\User::paginate(12);

        return view('root.users.index')->with($data);
    }
}
