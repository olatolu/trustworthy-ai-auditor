<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use App\Category;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        abort_if(Gate::denies('question_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reports = Report::all();

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reports.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReportRequest $request)
    {
        //
        $category = Category::findOrFail($request->category_id);

        if($category->sections == 0 && $category->bar_char == 0){
            return redirect()->back()->withInput(session()->flash('error_msg', 'An Error Occurred!!!'));
        }

        $report = Report::create($request->all());

        return redirect()->route('admin.reports.edit', $report->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report = Report::findOrFail($id);

        return view('admin.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report = Report::findOrFail($id);

        return view('admin.reports.edit', compact('categories', 'report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, $id)
    {
        //
        $report = Report::findOrfail($id);

        if ($report->is_for == 'section' && $report->category->sections > 0){

            if($request->section_id != $report->section_id && Report::whereCategoryId($report->category_id)->whereSectionId($request->section_id)->count() > 0){

                return redirect()->back()->withInput(session()->flash('error_msg', 'An Error Occurred - Record Exist for the selected section!!!'));
            }
        }

        $report->update($request->all());

        return redirect()->back()->with(session()->flash('message', 'Updated Successfully!!!'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Report $report
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Report $report)
    {
        //
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        Report::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
