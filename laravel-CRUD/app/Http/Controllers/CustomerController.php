<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = 'asc';
        $query = Customer::query();
        if($request->filled('firstname')){
            $query->where('firstname','like','%'.$request->firstname.'%');
        }
        if($request->filled('status')){
            $query->where('status',$request->status);
        }
        if($request->filled('sort')){
            if($request->sort=='Ascending'){
                $order = 'asc';
            }
            else{
                $order = 'desc';
            }
        }
        $customers = $query->orderBy('id', $order)->paginate(4)->withQueryString();
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required | min:2',
            'email' => 'required | email | unique:customers',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_picture' => 'required | file | mimes:png,jpg,jpeg | max:2048',
            'status' => 'required'
        ]);

        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->save();
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $name = $file->hashName();
            $extension = $file->getClientOriginalExtension();
            // $imageName = time() . '_' . $name . '.' . $extension;
            $imageName = now()->toDateString() . '_' . time() . '.' . $extension;
            $imagePath = 'customer/'.$imageName;
            $filePath = $file->storeAs('uploads', $imageName, 'public');

            $customer->profile_picture = $filePath;
            $customer->save();
        }

        return redirect(route('customers.index'))->with('success', 'Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Customer $customer)
    {
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('dashboard')],
            ['title' => 'Customers', 'url' => route('customers.index')],
            ['title' => 'Customers Details', 'url' => route('customers.show', $customer->id)],
        ];
        $request->session()->put('breadcrumbs', $breadcrumbs);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        // dd($customer);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required | min:2',
            'email' => 'required | email | unique:customers,email,'.$customer->id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_picture' => 'nullable | file | mimes:png,jpg,jpeg | max:2048',
            'status' => 'required'
        ]);
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->status = $request->status;
        $customer->save();
        if ($request->hasFile('profile_picture')) {
            if ($customer->profile_picture) {
                Storage::disk('public')->delete( $customer->profile_picture);
            }
            $file = $request->file('profile_picture');
            $name = $file->hashName();
            $extension = $file->getClientOriginalExtension();
            // $imageName = time() . '_' . $name . '.' . $extension;
            $imageName = now()->toDateString() . '_' . time() . '.' . $extension;
            $imagePath = 'customer/'.$imageName;
            $filePath = $file->storeAs('uploads', $imageName, 'public');

            $customer->profile_picture = $filePath;
            $customer->save();
        }

        return redirect(route('customers.index'))->with('success', 'Customer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        if($customer->profile_picture){
            Storage::disk('public')->delete($customer->profile_picture);
        }
        $customer->delete();
        return redirect(route('customers.index'))->with('success', 'Customer Deleted Successfully');
    }

    public function sendMail()
    {
        Mail::to('aayush.parmar@outlook.com')->send(new CustomerMail([
            'title' => 'Test Mail',
            'body' => 'Hello this is the test mail',
        ]));
    }
}
