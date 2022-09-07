<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Question;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all();

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        abort_if(Gate::denies('question_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.questions.create', compact('categories'));
    }

    public function store(StoreQuestionRequest $request)
    {
        //dd($request->all());
        $question = Question::create($request->all());

        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question)
    {
        abort_if(Gate::denies('question_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $question->load('category');

        return view('admin.questions.edit', compact('categories', 'question'));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $data = $request->all();

        //dd($data);

        $q = Category::findOrFail($request->category_id);

        if($q->sections > 0 && $question->question_label != null ){
            //$data['question_label'] = null;

        } else{

            if($q->sections == 0 && $question->question_label != null) {
                $data['section'] = null;
            }
        }

        $question->update($data);

        return redirect()->route('admin.questions.index')->with(session()->flash('message', 'Task was successful!'));
    }

    public function show(Question $question)
    {
        abort_if(Gate::denies('question_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->load('category');

        return view('admin.questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {
        abort_if(Gate::denies('question_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $question->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        Question::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function questionOptions($id){

        abort_if(Gate::denies('option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $options = Question::findOrFail($id)->questionOptions;

        return view('admin.options.index', compact('options'));
    }
}
