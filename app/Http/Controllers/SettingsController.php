<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SettingsController extends Controller
{
    //
    public function index() {
        $data['title'] = "";
        return view("manager.settings.index")->with($data);
    }

    public function update(Request $request) {

        $imageUploadDirectory = public_path() . '/content/logos/';
        

        // return $request->all();

        $this->validate($request, 
            [
                'company' => 'required',
                "image" => "mimes:jpeg,png,jpg,gif,jpg|max:1024",
            ]
        );

        if ($request->hasFile('image')) {
            $imageFile = date('D_H_m_s');
            Image::make($request
                    ->file('image')
                    ->move($imageUploadDirectory, $imageFile . "." . $request->file('image')->getClientOriginalExtension()))

                
                // ->resizeCanvas(80, 80, 'center', false,'ff00ff')
                
                // ->fit(80, 80)
                ->save();
        }

        


        $company = \App\Company::find(auth()->user()->company_id);

        $company->name = $request->input('company');

        // if image was uploaded
        if ($request->hasFile('image')) {
            $company->logo = $imageFile."." . $request->file('image')->getClientOriginalExtension();

            // if company had image 
            if (file_exists(public_path() . '/content/logos/' . $company->logo)) {
                @unlink(public_path() . '/content/logos/' . $this->file);
            }

        }
        $company->css = $request->input('css');
        $company->save();

        return redirect()->back()->with('s','Company settings updated');

    }
}
