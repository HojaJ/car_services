<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    public function index()
    {
        $datas = RequestModel::latest()->get();
        return view('admin.request.index', compact('datas'));
    }

    public function create(){}
    public function show($id){}


    public function destroy($id)
    {
        try{
            $data = RequestModel::find($id);
            $data->delete();
            return redirect()->route('request.index')->with('success', __('Deleted'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
