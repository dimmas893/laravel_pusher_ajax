<?php

namespace App\Http\Controllers;

use App\Events\KaryawanCreated;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $data = Karyawan::latest()->get();
            return response()->json(['data' => $data, 'ajax' => $data->count()], 200);
        }
        return view('karyawan.index')->with('success', 'Anda Ada Pesan Baru');
    }

    public function ajax_table()
    {
        $emps = User::latest()->get();
        // $csrf = @csrf;
        $output = '';
        $hitung = 0;
        $no = $hitung + 1;
        if ($emps->count() > 0) {
            $output .=
                '<table class="table table-striped table-sm align-middle" width="100%" cellspacing="0">
             <thead>
              <tr>
                <th>No</th>
                <th>name </th>
                <th>email</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $no++ . '</td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }


    public function create()
    {
        return view('karyawan.create');
    }
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);
        KaryawanCreated::dispatch();
        return back()->with('success', 'Data Berhasil Ditambah');
    }
}
