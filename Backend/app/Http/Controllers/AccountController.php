<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        $accounts = Account::with('user')->paginate(10);
        return response()->json($accounts, 201);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $account = Account::create($request->all());
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear la cuenta'], 500);
        }
        return response()->json($account, 201);
    }

    public function show(Account $account)
    {
        try {
            DB::beginTransaction();
            $account = Account::findOrFail($account->id);
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al retornar la cuenta'], 500);
        }
        return response()->json($account, 201);
    }

    public function update(Request $request, Account $account)
    {
        try {
            DB::beginTransaction();
            $account->update($request->all());
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar la cuenta'], 500);
        }
        return response()->json($account, 201);
    }

    public function destroy(Account $account)
    {
        try {
            DB::beginTransaction();
            $account = Account::findOrFail($account->id);
            $account->delete();
            DB::commit();
        } 
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar la cuenta'], 500);
        }
        return response()->json($account, 201);
    }
}
