<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    /**
     * Display the account index page.
     */
    public function index(): Response
    {
        $accounts = Account::all();

        return Inertia::render('Accounts', ['accounts' => $accounts]);
    }

    /**
     * Display the account create form.
     */
    public function create(): Response
    {
        return Inertia::render('Accounts/Create');
    }

    /**
     * Store the new account in database.
     */
    public function store(Request $request): RedirectResponse
    {
        $account = Account::create([
            'name' => $request->name,
            'type' => $request->type,
            'accountGroup' => $request->accountGroup,
            'accountOwner' => $request->accountOwner,
            'industry' => $request->industry,
        ]);

        return Redirect::route('accounts');
    }

    /**
     * Display the account edit form.
     */
    public function edit($accountId): Response
    {
        $account = Account::find($accountId);
        return Inertia::render('Accounts/Edit', ['account' => $account]);
    }

    /**
     * Update the account information.
     */
    public function update(Request $request): RedirectResponse
    {
        $account = Account::find($request->id);

        $account->name = $request->name;
        $account->type = $request->type;
        $account->accountGroup = $request->accountGroup;
        $account->accountOwner = $request->accountOwner;
        $account->industry = $request->industry;

        $account->save();
        return Redirect::route('accounts');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        return Redirect::route('accounts');
    }
}
