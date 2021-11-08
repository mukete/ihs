<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('cert', function() {
    return view('cert.cert');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function()
    {
        $data['title'] = trans('fe.dashboard');
        $data['courses'] = \App\Course::where('company_id','=',auth()->user()->company->id)->where('status','=',1)->take(4)->get();


        return View::make('user.dashboard')->with($data);
    });

    Route::get('kurses', function()
    {
        $data['title'] = trans('fe.courses');
        $data['courses'] = \App\Course::where('company_id','=',auth()->user()->company_id)->where('status','=',1)->paginate(10);
        if(Request::get('category') != null) {
            $data['courses'] = \App\Category::find(Request::get('category'))->courses()->where('company_id','=',auth()->user()->company_id)->where('status','=',1)->paginate(10);
        }

        $data['categories'] = \App\Category::where('company_id','=', auth()->user()->company_id)->paginate(10);
        return View::make('user.courses')->with($data);
    });

    Route::get('profil', function()
    {
        $data['title'] = trans('fe.profile');
        $data['courses'] = \App\Course::all();
        if(Request::get('category') != null) {
            $data['courses'] = \App\Category::find(Request::get('category'))->courses;
        }

        $data['categories'] = \App\Category::where('company_id','=', auth()->user()->company_id)->get();
        return View::make('user.profil')->with($data);
    });

    // Route::get('mitteilungen', function()
    // {
    //     $data['title'] = "Mitteilungen";
    //     $data['courses'] = \App\Course::all();
    //     if(Request::get('category') != null) {
    //         $data['courses'] = \App\Category::find(Request::get('category'))->courses;
    //     }

    //     $data['categories'] = \App\Category::where('company_id','=', auth()->user()->company_id)->get();
    //     return View::make('user.mitteilungen')->with($data);
    // });

    Route::get('settings', function()
    {
        $data['title'] = trans('fe.settings');
        $data['courses'] = \App\Course::all();
        if(Request::get('category') != null) {
            $data['courses'] = \App\Category::find(Request::get('category'))->courses;
        }

        $data['categories'] = \App\Category::where('company_id','=', auth()->user()->company_id)->get();
        return View::make('user.profil')->with($data);
    });

    Route::get('zertifikate', function()
    {
        $data['title'] = trans('fe.certificates');
        $data['courses'] = \App\Course::all();
        

        $data['categories'] = \App\Category::where('company_id','=', auth()->user()->company_id)->get();

        $data['tookPassed'] = \App\Take::where('user_id','=',auth()->user()->id)->where('pass','=','yes')->get();
        return View::make('user.zertifikate')->with($data);
    });

    Route::get('kurse/{slug}', function($slug)
    {
        $data['title'] = trans('fe.course');
        $data['course'] = \App\Course::where('slug','=', $slug)->first();
        $data['took'] = \App\Take::where('course_id','=',$data['course']->id)->where('user_id','=',auth()->user()->id)->first();
        return View::make('user.course')->with($data);
    });

    Route::get('kurse-view-document/{id}', function($id)
    {
        $data['title'] = trans('fe.document');
        $data['document'] = \App\Content::find($id);
        return View::make('user.document')->with($data);
    });

    Route::get('kurse-watch-video/{id}', function($id)
    {
        $data['title'] = trans('fe.document');
        $data['document'] = \App\Content::find($id);
        return View::make('user.video')->with($data);
    });

    Route::get('quiz/{slug}', function($slug)
    {   


        App::setLocale('de');
        $data['title'] = trans('fe.quiz');
        $data['course'] = \App\Course::where('slug','=', $slug)->first();

        // rturn 

        $took = \App\Take::where('course_id','=',$data['course']->id)->where('user_id','=',auth()->user()->id)->first();

        // initiate taking of quiz

        $checkExisting = \App\AnswerUser::where('course_id','=',$data['course']->id)->where('user_id','=',auth()->user()->id)->get();
        if( $checkExisting != null ) {
            // dlete record before adding again
            foreach($checkExisting as $checkDel) {
                $checkDel->delete();
            }
        }

        if(!\Request::get('page')) {
            if( $took == null ) {

                $take = new \App\Take();
                $take->user_id = auth()->user()->id;
                $take->course_id = $data['course']->id;
                $take->completed = 0;
                $take->times = 1;
                $take->save();
            }
            elseif($took->times < 3) {

                $took->times = $took->times  + 1;
                $took->save();
            }

            else {
                return redirect()->back()->with('e','You can not take this quiz more than 3 times');
            }
        }
        


        $data['questions'] = \App\Question::where('course_id','=',$data['course']->id)->paginate(1);
        return View::make('user.quiz')->with($data);
    });

    Route::get('results/{slug}', function($slug)
    {
        $data['title'] = trans('fe.quiz_results');
        $data['course'] = \App\Course::where('slug','=', $slug)->first();

        $data['answerUser'] = \App\AnswerUser::where('user_id','=',auth()->user()->id)->where('course_id','=',$data['course']->id)->get();
        
        $data['took'] = \App\Take::where('course_id','=',$data['course']->id)->where('user_id','=',auth()->user()->id)->first();



        // check if user passed , then send certificate via email
        if($data['answerUser']->where('correct','=',1)->count() > 0) {
            if( (($data['answerUser']->where('correct','=',1)->count()/$data['answerUser']->count())* 100 ) >= $data['course']->percentage  ) {

                // Now send email to user 

                $data['took']->pass = "yes";
                $data['took']->save();

                $mailData['course'] = $data['course']->title;
                $mailData['name'] = auth()->user()->name; 

                \Mail::to(auth()->user()->email)->send(new \App\Mail\SendCertMail($mailData));
            }
        }

        
        
        return View::make('user.results')->with($data);
    });

    Route::get('test',function(){
        return View::make('test');
    });




    // Route for managers
    // Route::prefix('manager')->group(function () {
    Route::group(['prefix' => 'manager',  'middleware' => ['auth','manager']], function() {
        Route::get('start', function () {
            // Matches The "/admin/users" URL
            $data['title'] = "";

            return view("manager.index")->with($data);
        });

        Route::resource('departments', '\App\Http\Controllers\DepartmentController');
        Route::resource('courses', '\App\Http\Controllers\CourseController');
        Route::resource('categories', '\App\Http\Controllers\CategoryController');
        Route::resource('users', '\App\Http\Controllers\UserController');
        Route::resource('questions', '\App\Http\Controllers\QuestionController');
        Route::resource('certificates', '\App\Http\Controllers\CertifcateController');

        Route::get('settings', 'SettingsController@index');
        Route::post('settings', 'SettingsController@update');
    });


    Route::group(['prefix' => 'root',  'middleware' => ['auth','admin']], function() {
        Route::get('start', function () {
            // Matches The "/admin/users" URL
            $data['title'] = "";

            return view("root.index")->with($data);
        });

        Route::get('companies', '\App\Http\Controllers\RootController@companies');
        Route::get('companies/create', '\App\Http\Controllers\RootController@addCompany');
        Route::post('companies', '\App\Http\Controllers\RootController@saveCompany');


        Route::get('departments', '\App\Http\Controllers\RootController@departments');
        Route::get('categories', '\App\Http\Controllers\RootController@categories');
        Route::get('courses', '\App\Http\Controllers\RootController@courses');
        Route::get('users', '\App\Http\Controllers\RootController@users');

    });
});


Route::post('change-name', 'HomeController@updateName');
Route::post('change-avatar', 'HomeController@updateAvatar');
Route::post('change-password', 'HomeController@updatePassword');




Auth::routes();
Route::get('remove-user-department/{user}/{department}', function($user,$department) {

    $department = \App\Department::find($department);
    $department->users()->detach($user);

    return redirect()->back()->with('s','');
});

Route::post('send-answer', function(\Illuminate\Http\Request $request) {


    $answer = \App\Answer::find($request->input('answer'));
    $course = \App\Course::find($request->input('course'));

    $took = \App\Take::where('course_id','=',$request->input('course'))->where('user_id','=',auth()->user()->id)->first();

    // return $answer;

    // return $request->all();

    $submitted = new \App\AnswerUser();
    $submitted->answer_id = $request->input('answer');
    $submitted->question_id = $request->input('question');
    $submitted->course_id = $request->input('course');
    $submitted->company_id = auth()->user()->company_id;
    $submitted->user_id = auth()->user()->id;
    $submitted->correct = $answer->correct == "yes" ? 1 : 0;

    $submitted->save();

    if($request->input('next') == null) {
        // send to result page 
        $took->completed = 1;
        $took->save();
        return redirect()->to('results/'.$course->slug);
    }

    return redirect()->to($request->input('next'));

    // return $request->all();

});



Route::post('add-to-department', function(\Illuminate\Http\Request $request) {

    $department = \App\Department::find($request->input('department'));

    // foreach($request->input('users') as $u) {
    //     $department->users()->attach($u);
    // }
    $department->users()->syncWithoutDetaching($request->input('users'));
    return redirect()->back()->with('s','');
});

Route::get('delete-content/{id}', function($id) {
    $content  = \App\Content::find($id);
    $content->delete();

    return redirect()->back()->with('s', 'Course content file deleted');
});

Route::post('change-status/{id}', function($id, \Illuminate\Http\Request $request) {
    $course  = \App\Course::find($id);

    if($request->input('status') != null) {
        $course->status = $request->input('status');
    }

    else {
        $course->status = 0;
    }

    // return $request->all();
    $course->save();

    return redirect()->back()->with('s', 'Course status updated');
});

Route::get('get-certificate/{id}', function($id){


    $took = \App\Take::find($id);

    $data['name'] = $took->user->name;
    $data['course'] = $took->course->name;

    $pdf = PDF::loadView('cert.certpdf', $data)->setPaper(array(0,0,590,480), 'portrait');
    return $pdf->download(str_replace(' ', '-', $took->course->name).'-zertifikate.pdf');
});

Route::get('reset-course-taken-times/{id}', function($id) {
    $took = \App\Take::find($id);
    $took->times = 0;
    $took->save();

    return redirect()->back()->with('s','User can now retake the course');
});



Route::get('/home', 'HomeController@index')->name('home');
