<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Category;
use App\Base;
use Auth;
use App\Scopes\Basescope;
use Illuminate\Http\Request;
use DataTables;


class CategoriesController extends Controller
{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BaseScope);
    }

    // public function index()
    // {
    //     abort_unless(\Gate::allows('categories_access'), 403);

    //     $categories = Category::all();

    //     return view('admin.categories.index', compact('categories'));
    // }

    public function index(Request $request)
    {
        abort_unless(\Gate::allows('categories_access'), 403);
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.categories.index2');
    }

    public function create()
    {
        abort_unless(\Gate::allows('base_create'), 403);

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        abort_unless(\Gate::allows('category_create'), 403);

        $category = Category::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
            'base_id' => Base::activeBase(),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        abort_unless(\Gate::allows('base_show'), 403);

        return view('admin.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        abort_unless(\Gate::allows('base_delete'), 403);

        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
