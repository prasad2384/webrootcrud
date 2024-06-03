<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    //
    function show_employee()
    {
        return view('employeelist');
    }
    function fetch_employee_api()
    {
        $data = employee::all();
        return response()->json(['status' => 'success', 'employees' => $data,], 200);
    }
    function add_employee()
    {
        return view('addemployee');
    }
    function add_employee_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|in:Male,Female,Others',
            'age' => 'required|integer|between:18,60',
            'email' => 'required|email|unique:employees,email',
            'mobile_number' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'address' => 'required|string',
        ], [
            'gender.in' => 'The gender must be one of the following: Male, Female, or Others.',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $gender = $request->get('gender');
        $age = $request->get('age');
        $email = $request->get('email');
        $mobile_number = $request->get('mobile_number');
        $address = $request->get('address');
        $data = new employee([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'age' => $age,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'address' => $address
        ]);
        if ($data->save()) {
            return response()->json(['status' => 200, 'message' => 'Person Add Successfully']);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'error'
            ]);
        }
    }
    function delete_employee_api($id)
    {
        $data = employee::find($id);
        if ($data->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Employee Deleted Successully...'], 200);
        }
    }
    function update_employee($id)
    {
        $data = employee::find($id);
        return view('editemployee', compact('data'));
    }
    function update_employee_api(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'gender' => 'required|in:Male,Female,Others',
            'age' => 'required|integer|between:18,60',
            'email' => [
                'required',
                'email',
                Rule::unique('employees')->ignore($id),
            ],
            'mobile_number' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'address' => 'required|string',
        ], [
            'gender.in' => 'The gender must be one of the following: Male, Female, or Others.',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->errors()]);
        }
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $gender = $request->get('gender');
        $age = $request->get('age');
        $email = $request->get('email');
        $mobile_number = $request->get('mobile_number');
        $address = $request->get('address');
        $data = employee::find($id);
        $data->first_name = $first_name;
        $data->last_name = $last_name;
        $data->gender = $gender;
        $data->age = $age;
        $data->email = $email;
        $data->mobile_number = $mobile_number;
        $data->address = $address;
        if ($data->update()) {
            return response()->json(['status' => 'success', 'message' => 'Employee Update Successfully'], 200);
        }
        else{
            return response()->json(['status' => 'false', 'message' => 'error'], 200);
        }
    }
}
