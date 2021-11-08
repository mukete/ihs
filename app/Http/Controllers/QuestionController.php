<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $data['courses'] = \App\Course::where('company_id','=', auth()->user()->company_id)->get();
        $data['questions'] = [];
        if(\Request::get('course') != null) {
            $data['questions'] = \App\Course::find(\Request::get('course'))->questions()->paginate(12);
        } 
        return view("manager.questions.index")->with($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,
            [
            'question' => 'required',
            'answers' => 'required',
            'corrects' => 'required',
        ]);


        $question = new \App\Question();
        $question->name = $request->input('question');
        $question->course_id = $request->input('course');
        $question->company_id = auth()->user()->company_id;
        $question->save();

        for($i=0; $i<4; $i++) {
            $answer = new \App\Answer();
            $answer->name = $request->input('answers')[$i];
            $answer->correct = $request->input('corrects')[$i];
            $answer->question_id = $question->id;
            $answer->course_id = $request->input('course');
            $answer->company_id = auth()->user()->company_id;
            $answer->save();
        }

        // return $request->all();

        return redirect()->back()->with('s', 'Question and answers added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    

        $question->delete();
        return redirect()->back()->with('s','Deleted');
    }
}
