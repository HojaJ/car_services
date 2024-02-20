<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function calendar(Request $request, $id)
    {
        $events = [];
        $worker = Worker::find($id);

        $appointments = Appointment::where('worker_id', $worker->id)->with(['worker', 'user'])->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->user->first_name . ' ' . $appointment->user->last_name,
                'start' => $appointment->start_time,
                'url'   => route('appointment.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events', 'worker'));
    }

    public function index()
    {
        $datas = User::latest()->get();
        return view('admin.admin.index', compact('datas'));
    }

    public function create(){}
    public function show($id){}



    public function update(Request $request, $id)
    {
        try {
            $data = User::find($id);
            if ($request->password){
                $data->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            $data->update([
                'first_name'    => $request->first_name,
                'last_name'    => $request->last_name,
                'email'    => $request->email,
                'phone'    => $request->phone,
            ]);
            return redirect()->route('admin.index')->with('success', __('Edited'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('admin.admin.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = User::find($id);
            $data->delete();
            return redirect()->route('admin.index')->with('success', __('Deleted'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
