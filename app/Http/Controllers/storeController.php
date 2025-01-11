<?php

namespace App\Http\Controllers;

use App\Models\Sellers;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::all();
        return $this->sendResponse($store,'display all Products data');
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
        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
    
        // Check if the user is authenticated and has the correct role (seller)
        $user = auth()->user();
    
        if (!$user || $user->role != 2) {  // Assuming 2 is the role for sellers
            return $this->sendError('Unauthorized', ['error' => 'You must be a seller to create a store.']);
        }
    
        // Fetch the seller record associated with the authenticated user
        $seller = Sellers::where('user_id', $user->id)->first();
    
        if (!$seller) {
            return $this->sendError('Seller not found', ['error' => 'The authenticated user is not a seller.']);
        }
    
        // Create or update store details
        $store = Store::updateOrCreate(
            ['seller_id' => $seller->id],  // Use the seller's ID
            [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]
        );
    
        // Return success response
        return $this->sendResponse($store, 'Store details saved successfully');
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
