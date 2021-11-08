<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('questions/{id}', function($id){

    $course = \App\Course::find($id);

//     $questions = [];

//     // return $course->questions->count();

//     foreach($course->questions as $question) {
//         array_push($questions, ['id' => $question->id, 'name' => $question->name]);
//     }
    
// return $questions;

    $course->setDefaultLocale('de');

    return  $course->questions;

    return \App\Course::find($id)->questions;
});

Route::get('question/{id}', function($id) {

    $q = \App\Question::find($id);

    $question['id'] = $q->id;
    $question['name'] = $q->name;

    $answers = array();

    foreach($q->answers as $answer) {
        array_push($answers, ['id'=>$answer->id, 'name'=>$answer->name]);
    }

    return ['question' => $question, 'answers' => $answers];
} );

Route::get('course/{id}', function($id) {

    $c = \App\Course::find($id);


    // return $c->questions->random($c->random);

    $quiz['total'] = $c->random;
    $quiz['duration'] = $c->duration;
    $quiz['percentage'] = $c->percentage;

    $questions = array();

    foreach($c->questions->random($c->random) as $question) {
        array_push($questions, ['id'=>$question->id, 'name' => $question->name]);
    }

    $quiz['questions'] = $questions;

    return $quiz;

    return $c;
} );

Route::post('send', function(\Illuminate\Http\Request $request) {

    // return ['status' => "OK", 'answer' => $request->all()];

    $course = \App\Course::find($request->input('course'));


    $answer = \App\Answer::find($request->input('answer'));

    

    $took = \App\Take::where('course_id','=',$request->input('course'))->where('user_id','=',$request->input('user'))->first();

    $checkExisting = \App\AnswerUser::where('question_id','=',$request->input('question'))->where('course_id','=',$request->input('course'))->where('user_id','=',$request->input('user'))->get();

    if( $checkExisting != null ) {
        // dlete record before adding again
        foreach($checkExisting as $checkDel) {
            $checkDel->delete();
        }
    }

    $submitted = new \App\AnswerUser();
    $submitted->answer_id = $request->input('answer');
    $submitted->question_id = $request->input('question');
    $submitted->course_id = $request->input('course');
    $submitted->company_id = $request->input('company');
    $submitted->user_id = $request->input('user');
    $submitted->correct = $answer->correct == "yes" ? 1 : 0;

    $submitted->save();

    if($request->input('end') == true) {
        // send to result page 
        $took->completed = 1;
        $took->save();

        return ['status' => "OK", 'url' => url('results/'.$course->slug) ];
        // return redirect()->to('results/'.$course->slug);
    }

    // return redirect()->to($request->input('next'));
    return ['status' => "OK", 'url' => null];

    // return $request->all();

});

Route::post('end', function(\Illuminate\Http\Request $request) {

    $course = \App\Course::find($request->input('course'));

    $took = \App\Take::where('course_id','=',$request->input('course'))->where('user_id','=',$request->input('user'))->first();

    if($request->input('end') == true) {
        $took->completed = 1;
        $took->save();
        return ['status' => "OK", 'url' => url('results/'.$course->slug) ];
    }
    return ['status' => "OK", 'url' => null];
});
