<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data['title'] = trans('manager.categories');
        $data['categories'] = \App\Category::paginate(10);
        return view("manager.categories.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = trans('manager.add_category');
        return view("manager.categories.create")->with($data);
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

        $upload = public_path() . '/content/category/';

        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,gif,png|max:1024'
        ]);

        $imageName = date('D_H_m_s');
        Image::make($request
                ->file('image')
                ->move($upload, $imageName . "." . $request->file('image')->getClientOriginalExtension()))
            ->fit(640, 400)
            ->save();

        $category = new \App\Category();
        $category->name = $request->input('name');
        $category->company_id = auth()->user()->company_id;
        $category->image = $imageName . "." . $request->file('image')->getClientOriginalExtension();
        $category->save();

        // return $category
        return redirect()->to('manager/categories')->with('s', trans('manager.added_success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //


        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //

        $data['title'] = trans('manager.edit_category');
        $data['category'] = $category;
        return view("manager.categories.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //

        $upload = public_path() . '/content/category/';

        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,gif,png|max:1024'
        ]);

        if ($request->file('image')) {
            $imageName = date('D_H_m_s');
            Image::make($request
                    ->file('image')
                    ->move($upload, $imageName . "." . $request->file('image')->getClientOriginalExtension()))
                ->fit(640, 400)
                ->save();
        }

        $category->name = $request->input('name');
        if ($request->file('image')) {
            $category->image = $imageName . "." . $request->file('image')->getClientOriginalExtension();
        }
        $category->save();

        return redirect()->to('manager/categories')->with('s', trans('manager.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        \App\Category::find($id)->delete();
        return redirect()->to('manager/categories')->with('s', trans('manager.delete_category_success'));
    }
}
