<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function show(Client $client) {
        return response()->json($client,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $clients = Client::where('name','like',"%$request->key%")
            ->orWhere('email','like',"%$request->key%")->get();

        return response()->json($clients, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|required',
            'address' => 'string|required',
            'phone' => 'numeric|required',
            'capitalization' => 'decimal|required',
            'loan_balance' => 'decimal|required',
        ]);

        try {
            $client = Client::create($request->all());
            return response()->json($client, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Client $client) {
        try {
            $client->update($request->all());
            return response()->json($client, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Client $client) {
        $client->delete();
        return response()->json(['message'=>'Client deleted.'],202);
    }

    public function index() {
        $clients = Client::orderBy('name')->get();
        return response()->json($clients, 200);
    }
}