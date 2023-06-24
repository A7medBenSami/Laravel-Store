<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\dashboard\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::leftJoin('categories as parents' , 'parents.id','=', 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])
        ->paginate();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = category::all();
        $category = new category();
        return view('dashboard.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug'=> Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        $categories = category::create($data);
        return redirect()->route('categories.index')->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($q) use ($id){
                $q->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $oldimage = $category->image;
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request);


            if ($oldimage && $data['image']){
                Storage::disk('public')->delete($oldimage);
            }
        } else {
            $data['image'] = $oldimage;
        }

        $category->update($data);
        return redirect()->route('categories.index')->with('success','Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::destroy($id);
        return redirect()->route('categories.index')->with('success','Category Deleted!');
    }


    protected function uploadImage(Request $request){
        if (!$request->hasFile('image')){
            return;
        }
        $file = $request->file('image');
        $path = $file->store('upload',['disk'=>'public']);
        return $path;
    }
}
