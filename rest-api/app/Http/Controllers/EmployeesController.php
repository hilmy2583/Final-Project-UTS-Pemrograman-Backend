<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employees::all();

        if($employees->isEmpty()){
            $data = [
                'message' => 'Data Is Empty'
            ];
            return response()->json($data, 200);
        }
        $data = [
            'message' => 'Get All Resource',
            'data' => $employees
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'email' => 'email|required',
            'status' => 'required',
            'hired_on' => 'required'
        ]);

        $employees = Employees::create($validatedData);

        $data = [
            'message' => 'Resource Is Added Succesfully',
            'data' => $employees
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employees = Employees::find($id);

        if($employees) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $employees = Employees::find($id);

        if($employees) {
            $input = [
                'name' => $request->name ?? $employees->name,
                'gender' => $request->gender ?? $employees->gender,
                'phone' => $request->phone ?? $employees->phone,
                'address' => $request->address ?? $employees->address,
                'email' => $request->email ?? $employees->email,
                'status' => $request->status ?? $employees->status,
                'hired_on' => $request->hired_on ?? $employees->hired_on
            ];

            $employees->update($input);

            $data = [
                'message' => 'Resource Is Update Succesfully',
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employees = Employees::find($id);

        if($employees) {
            $employees->delete();

            $data = [
                'message' => 'Resource Is Delete Succesfully',
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
        else {
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }
    }

    // Mencari resource by name
    public function search(string $name)
    {
        $employees = Employees::where('name', '=', $name)->get();

        if($employees->isEmpty()) {
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }

        if($employees) {

            $data = [
                'message' => 'Get Searched Resource',
                'data' => $employees
            ];

            return response()->json($data, 200);
        }

        else {
            $data = [
                'message' => 'Resource Not Found'
            ];

            return response()->json($data, 404);
        }
    }

    // Mendapatkan resource yang aktif
    public function active()
    {
        $employees = Employees::where('status', '=', 'active')->get();

        if($employees) {

            $data = [
                'message' => 'Get Active Resource',
                'total' => $employees->count(),
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
    }

    // Mendapatkan resource yang tidak aktif
    public function inactive()
    {
        $employees = Employees::where('status', '=', 'inactive')->get();

        if($employees) {

            $data = [
                'message' => 'Get Inactive Resource',
                'total' => $employees->count(),
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
    }

    // Mendapatkan resource yang diberhentikan
    public function terminated()
    {
        $employees = Employees::where('status', '=', 'terminated')->get();

        if($employees) {

            $data = [
                'message' => 'Get Terminated Resource',
                'total' => $employees->count(),
                'data' => $employees
            ];

            return response()->json($data, 200);
        }
    }
}
