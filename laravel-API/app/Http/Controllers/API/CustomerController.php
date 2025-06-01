<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json([
            'status' => true,
            'message' => 'Customers retrieved successfully',
            'data' => $customers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required|min:2',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_picture' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('profile_picture')) { 
            $file = $request->file('profile_picture');
            $name = $file->hashName();
            $extension = $file->getClientOriginalExtension();
            $imageName = now()->toDateString() . '_' . time() . '.' . $extension;
            $imagePath = 'customer/'.$imageName;
            $filePath = $file->storeAs('uploads', $imageName, 'public');

            $data['profile_picture'] = $filePath;
            // $customer->save();
        }else{
            $data['profile_picture'] = 'uploads/Default.png';
        }

        $customer = Customer::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'] == 'Active' ? '1' : '0',
            'profile_picture' => $data['profile_picture'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Customer not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Customer found successfully',
            'data' => $customer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $customer = Customer::find($id);
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Customer not found'
            ], 404);
        }

        $validator = Validator::make($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required | min:2',
            'email' => 'required | email | unique:customers,email,'.$id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_picture' => 'nullable | file | mimes:png,jpg,jpeg | max:2048',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        $data = $validator->validated();
        $data['status'] = $data['status'] == 'Active' ? '1' : '0';

        if ($request->hasFile('profile_picture')) {
            if ($customer->profile_picture && $customer->profile_picture!='uploads/Default.png' && Storage::disc('public')->exists($customer->profile_picture)) {
                Storage::disk('public')->delete( $customer->profile_picture);
            }
            $file = $request->file('profile_picture');
            $name = $file->hashName();
            $extension = $file->getClientOriginalExtension();
            $imageName = now()->toDateString() . '_' . time() . '.' . $extension;
            $imagePath = 'customer/'.$imageName;
            $filePath = $file->storeAs('uploads', $imageName, 'public');

            $data['profile_picture'] = $filePath;
        }

        $customer->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully',
            'data' => $customer
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if(!$customer){
            return response()->json([
                'status' => false,
                'message' => 'Customer not found'
            ], 404);
        }
        if($customer->profile_picture && $customer->profile_picture!='uploads/Default.png' && Storage::disc('public')->exists($customer->profile_picture)) {
            Storage::disk('public')->delete($customer->profile_picture);
        }

        $customer->delete();

        return response()->json([
            'status' => true,
            'message' => 'Customer Deleted Successfully'
        ], 200);
    }
}
