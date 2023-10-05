<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all() ;
        return view('admin.category.create' , compact('categories'));
    }

    function getdata(Request $request){
        $categories = Category::query() ;
        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('actions' , function ($qur){
                return '<div class="d-flex align-items-center gap-3 fs-6">
                                <div  class="text-primary"
                                ><i class="bi bi-eye-fill"></i></div>
                                <div  class="text-warning edit_btn" data-id="'. $qur->id .'" data-name="'. $qur->name  .'" data-parent="'. $qur->parent_id .'" data-desc="'. $qur->description .'" data-bs-toggle="modal" data-bs-target="#modal-update"><i class="bi bi-pencil-fill"></i></div>
                                <div  class="text-danger delete_btn" data-url="/admin/category/delete/'. $qur->id .'" ><i class="bi bi-trash-fill"></i></div>
                                </div>';
            })
            ->addColumn('parent' , function ($qur){
                return $qur->parent->name;
            })
        
            ->rawColumns(['parent' , 'actions' , 'date'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
           'name' => 'required' ,
           'parent' => 'nullable' ,
           'description' => 'required' ,
           'image' => 'required' ,
        ]);

        $nameimage = time() . '_' . rand() . '.' . $request->file('image')->getClientOriginalExtension() ;
        $request->file('image')->move(public_path('uploads') , $nameimage) ;

        Category::create([
            'name' => $request->name ,
            'slug' => Str::slug($request->name) ,
            'parent_id' => $request->parent ,
           'description' => $request->description ,
           'image' => $nameimage ,
        ]);

        $categories = Category::all() ;
        //return view('admin.parts.list-categories' , compact('categories'))->render() ;


        /*
         * {
         * "success": "Added Successful"
         * }
         *
         *
         *
         */
        return response()->json([
            "success" => "Added Successful"
        ] , 201);
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required' ,
            'parent' => 'nullable' ,
            'description' => 'required' ,
        ]);
        $category = Category::query()->findOrFail($request->id);


        if($request->has('image')){
            $nameimage = time() . '_' . rand() . '.' . $request->file('image')->getClientOriginalExtension() ;
            $request->file('image')->move(public_path('uploads') , $nameimage) ;

            $category->update([
                'image' => $nameimage
            ]);
        }

        $category->update([
            'name' => $request->name ,
            'slug' => Str::slug($request->name) ,
            'parent_id' => $request->parent ,
            'description' => $request->description ,
        ]);

        return response()->json([
            "success" => "Updated Successful"
        ]  , 201) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {

        Category::destroy($id);
        return response()->json([
            "success" => "Deleted Successful"
        ] , 201);


    }
}