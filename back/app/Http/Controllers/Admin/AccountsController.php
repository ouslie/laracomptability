<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Account;
use App\Base;
use Auth;
use App\Scopes\Basescope;


class AccountsController extends Controller
{

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BaseScope);
    }

    public function index()
    {
        abort_unless(\Gate::allows('base_access'), 403);

        $accounts = Account::all();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('base_create'), 403);

        return view('admin.accounts.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        abort_unless(\Gate::allows('category_create'), 403);

        $account = Account::create([
            'name' => request('name'),
            'user_id' => Auth::id(),
            'base_id' => Base::activeBase(),
        ]);

        return redirect()->route('admin.accounts.index');
    }

    public function edit(Account $account)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        return view('admin.accounts.edit', compact('account'));
    }

    public function update(UpdateCategoryRequest $request, Account $account)
    {
        abort_unless(\Gate::allows('base_edit'), 403);

        $account->update($request->all());

        return redirect()->route('admin.accounts.index');
    }

    public function show(Account $account)
    {
        abort_unless(\Gate::allows('base_show'), 403);

        return view('admin.accounts.show', compact('account'));
    }

    public function destroy(Account $account)
    {
        abort_unless(\Gate::allows('base_delete'), 403);

        $account->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Account::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
