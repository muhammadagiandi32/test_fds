<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Employee::get();
        // dd($data);
        if ($data) {
            return response()->json([
                'msg' => 'ok',
                'data' => $data
            ], 200);
        } else {
            return response()->json(['msg' => 'Data Tidak di Temukan'], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $data =   Employee::insert([
            'Name' => $request->name,
            'TanggalLahir' => $request->date,
            'Gaji' => $request->gaji,
            'StatusKaryawan' => 1
        ]);

        if ($data) {
            return response()->json(['msg' => 'Data Berhasil di Buat'], 200);
        } else {
            return response()->json(['msg' => 'Data Gagal di Buat'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
        $data =  Employee::where('id', $employee->id)->get();
        // dd($data);
        if ($data) {
            return response()->json([
                'msg' => 'ok',
                'data' => $data
            ], 200);
        } else {
            return response()->json(['msg' => 'Data Tidak di Temukan'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Employee $employee)
    {
        $employee = Employee::find($id);

        $input = $request->all();

        $employee->fill($input)->save();

        if ($input) {
            return response()->json(['msg' => 'Data Berhasil di ubah'], 200);
        } else {
            return response()->json(['msg' => 'Data Gagal di ubah'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $data = Employee::where('id', $employee->id)->delete();

        if ($data) {
            return response()->json(['msg' => 'Data Berhasil di Hapus'], 200);
        } else {
            return response()->json(['msg' => 'Data Gagal di Hapus'], 401);
        }
    }
}
