<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = "";
        $data['courses'] = \App\Course::where('company_id','=', auth()->user()->company_id)->paginate(10);
        return view("manager.courses.index")->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = trans('manager.add_course');
        $data['categories'] = \App\Category::where('company_id','=',auth()->user()->company_id)->get();
        return view("manager.courses.create")->with($data);
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
        // return $request->all();

        // return $request->all();

        // return $request->input('videos');

         $imageUploadDirectory = public_path() . '/content/courses/';
         $documentUploadDirectory = public_path() . '/content/documents/';
        $this->validate($request, 
            [
                'name' => 'required',
                'category' => 'required',
                'duration' => 'required',
                'random' => 'required',
                'percentage' => 'required',
                "image" => "required|mimes:jpeg,png,jpg,gif,jpg|max:1024",
                "documents.*" => "mimes:pdf,doc,docx,xls,pptx,ppt,xlsx|max:2048",
            ]
        );

        // saving image 

        $imageFile = date('D_H_m_s');
        Image::make($request
                ->file('image')
                ->move($imageUploadDirectory, $imageFile . "." . $request->file('image')->getClientOriginalExtension()))
            ->fit(640, 400)
            ->save();

        $course = new \App\Course();
        $course->name = $request->input('name');
        $course->random = $request->input('random');
        $course->duration = $request->input('duration');
        $course->percentage = $request->input('percentage');
        $course->category_id = $request->input('category');
        $course->company_id = auth()->user()->company_id;
        $course->image = $imageFile."." . $request->file('image')->getClientOriginalExtension();
        $course->save();


        // if upload has youtube iframe elements
        if ($request->has('videos')) {
            foreach ($request->input('videos') as $video) {
                // $fileName = time() . "_" . uniqid(8) . "." . $document->getClientOriginalExtension();

                // echo $fileName; die();
                // $document->move($documentUploadDirectory, $fileName);

                if($video != null){
                    $content = new \App\Content();
                    $content->file = $video;
                    $content->type = 'videos';
                    $content->course_id = $course->id;
                    $content->company_id = auth()->user()->company_id;
                    $content->save();
                }
            }

        }


        


        // if upload has documents 
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $fileName = time() . "_" . uniqid(8) . "." . $document->getClientOriginalExtension();

                // echo $fileName; die();
                $document->move($documentUploadDirectory, $fileName);

                $content = new \App\Content();
                $content->file = $fileName;
                $content->type = 'documents';
                $content->course_id = $course->id;
                $content->company_id = auth()->user()->company_id;
                $content->save();
            }

        }

        return redirect()->to('manager/courses')->with('s', 'Course added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        $data['title'] = trans('manager.add_course');
        $data['categories'] = \App\Category::where('company_id','=',auth()->user()->company_id)->get();
        $data['course'] = $course;
        return view("manager.courses.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
        //

        // return $request->all();
         $imageUploadDirectory = public_path() . '/content/courses/';
         $documentUploadDirectory = public_path() . '/content/documents/';
        $this->validate($request, 
            [
                'name' => 'required',
                'category' => 'required',
                'duration' => 'required',
                'percentage' => 'required',
                "image" => "mimes:jpeg,png,jpg,gif,jpg|max:1024",
                "documents.*" => "mimes:pdf,doc,docx,xls,pptx,ppt,xlsx:2048",
            ]
        );

        // saving image 
        if ($request->hasFile('image')) {
            $imageFile = date('D_H_m_s');
            Image::make($request
                    ->file('image')
                    ->move($imageUploadDirectory, $imageFile . "." . $request->file('image')->getClientOriginalExtension()))
                ->fit(640, 400)
                ->save();
        }

        // $course =  \App\Course();
        $course->name = $request->input('name');
        $course->category_id = $request->input('category');
        $course->duration = $request->input('duration');
        $course->percentage = $request->input('percentage');
        $course->company_id = auth()->user()->company_id;
        if ($request->hasFile('image')) {
            $course->image = $imageFile."." . $request->file('image')->getClientOriginalExtension();
        }
        $course->save();



        // if upload has youtube iframe elements
        if ($request->has('videos')) {
            foreach ($request->input('videos') as $video) {
                // $fileName = time() . "_" . uniqid(8) . "." . $document->getClientOriginalExtension();

                // echo $fileName; die();
                // $document->move($documentUploadDirectory, $fileName);

                if($video != null){
                    $content = new \App\Content();
                    $content->file = $video;
                    $content->type = 'videos';
                    $content->course_id = $course->id;
                    $content->company_id = auth()->user()->company_id;
                    $content->save();
                }
            }

        }

        


        // if upload has documents 
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $fileName = time() . "_" . uniqid(8) . "." . $document->getClientOriginalExtension();

                // echo $fileName; die();
                $document->move($documentUploadDirectory, $fileName);

                $content = new \App\Content();
                $content->file = $fileName;
                $content->type = 'documents';
                $content->course_id = $course->id;
                $content->company_id = auth()->user()->company_id;
                $content->save();
            }

        }

        return redirect()->to('manager/courses')->with('s', 'Course added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
