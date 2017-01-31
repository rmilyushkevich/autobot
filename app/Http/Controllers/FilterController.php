<?php

namespace App\Http\Controllers;

use App\Mark;
use App\Helpers\YearHelper;
use App\Http\Requests\NewFilterRequest;
use App\Filter;
use Auth;
use App\Http\Requests\UpdateFilterRequest;

class FilterController extends Controller
{
    public function create()
    {
        $marks = Mark::all();
        $years = YearHelper::getYears();

        return view('filters.create', compact('marks', 'years'));
    }

    public function save(NewFilterRequest $request)
    {
        $attrs = $request->all();
        $attrs['user_id'] = Auth::user()->id;

        $filter = new Filter($attrs);
        $filter->saveOrFail();

        return redirect()->to('/');
    }

    public function edit($id)
    {
        $filter = Filter::where('id', $id)->with('mark', 'model')->first();
        $marks = Mark::all();
        $years = YearHelper::getYears();

        return view('filters.edit', compact('filter', 'marks', 'years'));
    }

    public function update(UpdateFilterRequest $request)
    {
        $filter = Filter::findOrFail($request->id);
        $filter->fill($request->all());
        $filter->save();

        return redirect()->to('/');
    }

    public function delete($id)
    {
        Filter::destroy($id);
        return redirect()->to('/');
    }
}
