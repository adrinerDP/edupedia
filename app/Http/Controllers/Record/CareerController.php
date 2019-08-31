<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = auth()->user()->careers;

        return view('pages.records.career.list', compact('careers'));
    }

    public function create()
    {
        return view('pages.records.career.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'grade' => 'required|in:1,2,3'
        ]);

        Career::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'grade' => $request->grade,
            'body' => $request->body
        ]);

        return redirect()->route('careers.list');
    }

    public function show($id)
    {
        $career = Career::find($id);
        return view('pages.records.career.show', compact('career'));
    }

    public function edit($id)
    {
        $career = Career::find($id);
        return view('pages.records.career.edit', compact('career'));
    }

    public function update(Request $request, $id)
    {
        $career = Career::find($id);
        $career->title = $request->title;
        $career->grade = $request->grade;
        $career->body = $request->body;
        $career->save();

        return redirect()->route('careers.show', $career->id);
    }

    public function destroy($id)
    {
        Career::destroy($id);

        return redirect()->route('careers.index');
    }
}
