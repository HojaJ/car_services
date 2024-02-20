<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $workers = Worker::latest()->get();
        $clients = User::where('is_admin', 0)->latest()->get();
        $datas = Appointment::latest()->get();
        return view('admin.appointment.index', compact('workers','clients','datas'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {
        try {
            Appointment::create([
                'start_time'            => Carbon::make($request->start_time),
                'finish_time'           => Carbon::make($request->finish_time),
                'worker_id'             => $request->worker_id,
                'user_id'               => $request->user_id,
                'comment'               => $request->comment
            ]);

            return redirect()->route('appointment.index')->with('success', __('Added'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Appointment::find($id);

            $data->update([
                'start_time'            => Carbon::make($request->start_time),
                'finish_time'           => Carbon::make($request->finish_time),
                'worker_id'             => $request->worker_id,
                'user_id'               => $request->user_id,
            ]);
            return redirect()->route('appointment.index')->with('success', __('Edited'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $workers = Worker::latest()->get();
        $clients = User::where('is_admin', 0)->latest()->get();
        $data = Appointment::find($id);
        return view('admin.appointment.edit', compact('data','workers','clients'));
    }

    public function destroy($id)
    {
        try{
            $data = Appointment::find($id);
            $data->delete();
            return redirect()->route('appointment.index')->with('success', __('Deleted'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
