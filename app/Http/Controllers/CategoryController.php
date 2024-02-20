<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{

    public function index()
    {
        $datas = Category::latest()->get();
        return view('admin.category.index', compact('datas'));
    }

    public function create(){}
    public function show($id){}

    public function store(Request $request)
    {
        try {
            $image = 'null';
            if ($request->image){
                $image = Support::storeFile($request->image, $request->name_tm, 'images');
            }

            Category::create([
                'name_tm'    => $request->name_tm,
                'name_ru'    => $request->name_ru,
                'name_en'    => $request->name_en,
                'image'      => $image
            ]);

            return redirect()->route('category.index')->with('success', 'Added');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Category::find($id);
            $image = $data->image;
            if ($request->image){
                File::delete($data->image);
                $image = Support::storeFile($request->image, $request->name_tm, 'images');
            }
            $data->update([
                'name_tm'    => $request->name_tm,
                'name_ru'    => $request->name_ru,
                'name_en'    => $request->name_en,
                'image'      => $image
            ]);
            return redirect()->route('category.index')->with('success', 'Edited');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin.category.edit', compact('data'));
    }

    public function destroy($id)
    {
        try{
            $data = Category::find($id);
            File::delete($data->image);
            $data->delete();
            return redirect()->route('category.index')->with('success', 'Deleted');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

}
