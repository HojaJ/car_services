<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Request as RequestModel;


class FrontController extends Controller
{
    public function index(Request $request)
    {
        $services = Category::latest()->get();
        return view('user.index',compact('services'));
    }

    public function cat_show(Request $request, Category $category)
    {
        $category->load('workers');
        return view('user.workers', compact('category'));
    }

    public function worker_show(Request $request, Worker $worker)
    {
        $events = [];

        $appointments = Appointment::where('worker_id', $worker->id)->with(['worker', 'user'])->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => __("Booked"),
                'start' => $appointment->start_time,
            ];
        }

        return view('user.worker', compact('worker','events'));
    }

    public function request_post(Request $request)
    {
        try {
            RequestModel::create([
                'start_time'            => Carbon::make($request->start_time),
                'finish_time'           => Carbon::make($request->finish_time),
                'worker_id'             => $request->worker_id,
                'user_id'               => auth()->user()->id,
            ]);

            return redirect()->route('index')->with('success', __('Sent'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }
}
