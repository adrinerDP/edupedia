<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Models\CreativeActivity;
use Illuminate\Http\Request;

class CreativeActivityController extends Controller
{
    private $typeName;

    public function __construct(Request $request)
    {
        $this->typeName = $this->checkType($request);
    }

    // 자율: VOLUNTARY, 동아리: CLUB, 봉사: SERVICE, 진로: CAREER
    public function index($type)
    {
        $results = CreativeActivity::where('user_id', auth()->user()->id)->where('type', $type)->get();
        return view('pages.records.creative.list', compact('results', 'type'), ['typeName' => $this->typeName]);
    }

    public function create($type)
    {
        return view('pages.records.creative.create', compact('type'), ['typeName' => $this->typeName]);
    }

    public function store(Request $request, $type)
    {
        //
    }

    public function show($type, $id)
    {
        //
    }

    public function edit($type, $id)
    {
        //
    }

    public function update(Request $request, $type, $id)
    {
        //
    }

    public function destroy($type, $id)
    {
        //
    }

    private function checkType(Request $request)
    {
        switch ($request->type) {
            case 'voluntary':
                return '자율활동';
                break;
            case 'club':
                return '동아리활동';
                break;
            case 'service':
                return '봉사활동';
                break;
            case 'career':
                return '진로활동';
                break;
            default:
                return abort(400);
        }
    }
}
