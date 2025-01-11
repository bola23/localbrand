<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\store;
use App\Models\Sellers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category::all();
        return $this->sendResponse($category,'display all Products data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 400);
        }

        // Retrieve the authenticated seller (assuming the user is a seller)
        $user = auth()->user();
        $seller = Sellers::where('user_id', $user->id)->first();

        // Find the seller's associated store
        $store = Store::where('seller_id', $seller->id)->first();

        // If the seller does not have a store, return an error
        if (!$store) {
            return response()->json([
                'success' => false,
                'message' => 'No store found for the authenticated seller',
                'data' => []
            ], 404);
        }

        // Create the category and associate it with the found store
        $category = Category::create([
            'name' => $request->name,
            'store_id' => $store->id, // Automatically use the seller's store ID
        ]);

        return $this->sendResponse($category, 'Store details saved successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
