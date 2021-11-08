<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        if(auth()->user()->type == "manager") {
            return redirect()->to('manager/start');
        }

        if(auth()->user()->type == "user") {
            return redirect()->to('/');
        }


        if(auth()->user()->type == "admin") {
            // return 'working on admin things';
            return redirect()->to('/');
        }
        return view('home');
    }


    public function updateName(Request $request) {

        $this->validate($request, ['vorname' => 'required', 'nachname' => 'required']);
        // return $request->all();

        $user = auth()->user();
        $user->name = $request->input('vorname')." ".$request->input('nachname');
        $user->save();

        return redirect()->back()->with('s', 'Name updated');
    }

    public function updateAvatar(Request $request) {

        $imageUploadDirectory = public_path() . '/content/users/';
        $this->validate($request, ["image" => "required|mimes:jpeg,png,jpg,gif,jpg|max:1024",]);
        // return $request->all();


        if($request->hasFile('image')) {
            $imageFile = auth()->user()->id.date('D_H_m_s');
        Image::make($request
                ->file('image')
                ->move($imageUploadDirectory, $imageFile . "." . $request->file('image')->getClientOriginalExtension()))
            ->fit(500, 500)
            ->save();
        }

        $user = auth()->user();
        $user->avatar = $imageFile. "." . $request->file('image')->getClientOriginalExtension();
        $user->save();

        return redirect()->back()->with('s', 'Avatar updated');
    }

    public function updatePassword(Request $request) {

        return $request->all();
    }
}
