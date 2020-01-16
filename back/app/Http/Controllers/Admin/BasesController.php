<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBaseRequest;
use App\Http\Requests\StoreBaseRequest;
use App\Http\Requests\UpdateBaseRequest;
use App\Base;
use Auth;
use JWTAuth;
use Session;
use Illuminate\Http\Request;

class BasesController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        abort_unless(\Gate::allows('base_access'), 403);
        $bases = Base::where('user_id', '=', Auth::id())->get();

        return view('admin.bases.index', compact('bases'));
    }

    public function get()
    {
        return $this->user
        ->bases()
        ->get()
        ->toArray();

        // abort_unless(\Gate::allows('base_access'), 403);
        // $bases = Base::where('user_id', '=', Auth::id())->get();
        // echo 'titit';
        // dd(Auth::id());
        // dd($bases);
        // return $bases;
    }

    public function changebase(Request $request, $id)
    {
        Session::put('base_id', $id);

        return $id;
    }

    public function create()
    {
        abort_unless(\Gate::allows('base_create'), 403);

        return view('admin.bases.create');
    }

    public function store(StoreBaseRequest $request)
    {
        abort_unless(\Gate::allows('base_create'), 403);

        $base = Base::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.bases.index');
    }

    public function edit(Base $base)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        return view('admin.bases.edit', compact('base'));
    }

    public function update(UpdateBaseRequest $request, Base $base)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        $base->update($request->all());

        return redirect()->route('admin.bases.index');
    }

    public function show(Base $base)
    {
        abort_unless(\Gate::allows('base_show'), 403);

        return view('admin.bases.show', compact('base'));
    }

    public function destroy(Base $base)
    {
        abort_unless(\Gate::allows('base_delete'), 403);

        $base->delete();

        return back();
    }

    public function massDestroy(MassDestroyBaseRequest $request)
    {
        Base::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }



}
