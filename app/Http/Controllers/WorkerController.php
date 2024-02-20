<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $datas = Worker::latest()->get();
        return view('admin.worker.index', compact('datas','categories'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {
        try {
            Worker::create([
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
                'category_id'           => $request->category_id,
                'profession_tm'         => $request->profession_tm,
                'profession_ru'         => $request->profession_ru,
                'profession_en'         => $request->profession_en,
                'working_hours_start'   => $request->working_hours_start,
                'working_hours_end'     => $request->working_hours_end,
            ]);

            return redirect()->route('worker.index')->with('success', __('Added'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Worker::find($id);

            $data->update([
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
                'category_id'           => $request->category_id,
                'profession_tm'         => $request->profession_tm,
                'profession_ru'         => $request->profession_ru,
                'profession_en'         => $request->profession_en,
                'working_hours_start'   => $request->working_hours_start,
                'working_hours_end'     => $request->working_hours_end,
            ]);
            return redirect()->route('worker.index')->with('success', __('Edited'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $categories = Category::latest()->get();
        $data = Worker::find($id);
        return view('admin.worker.edit', compact('data','categories'));
    }

    public function destroy($id)
    {
        try{
            $data = Worker::find($id);
            $data->delete();
            return redirect()->route('worker.index')->with('success', __('Deleted'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
