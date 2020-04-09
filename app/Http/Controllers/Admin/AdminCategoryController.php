<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class AdminCategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('name');

        $categories = Category::where('name','like',"%$nombre%")->orderBy('name')->paginate(2);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name',
            'slug' => 'required|max:50|unique:categories,slug'
        ]);

        $cat = Category::create($request->all());
        // $categories = Category::orderBy('name')->paginate(2);
        // return view('admin.category.index', compact('categories'));
        return redirect()->route('admin.category.index')->with('datos','Se creó la categoría nueva');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cat = Category::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        
        return view('admin.category.show',compact('cat','editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cat = Category::where('slug',$slug)->firstOrFail();
        $editar = 'Si';
        
        return view('admin.category.edit',compact('cat','editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,'.$cat->id,
            'slug' => 'required|max:50|unique:categories,slug,'.$cat->id,
        ]);

        $cat->fill($request->all())->save();

        return redirect()->route('admin.category.index')->with('datos','Se modificó la categoría');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.category.index')->with('datos','Se elimino la categoria');
    }
}
