<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session()->missing('username')) {
            return view('auth.login');
        } else {
            $users = Users::where('role', 'user')->get();
            return view('Users')->with('users', $users);
        }
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
        Session::flash('user_username', $request->user_username);
        Session::flash('user_fullname', $request->user_fullname);
        Session::flash('user_password', $request->user_password);

        $request->validate(
            [
                'user_fullname' => 'required',
                'user_username' => 'required',
                'user_password' => 'required',
            ],
            [
                'user_fullname.required' => 'Nama lengkap wajib diisi',
                'user_username.required' => 'username wajib diisi',
                'user_password.required' => 'password wajib diisi',
            ]
        );

        $data = [
            'username' => $request->input('user_username'),
            'fullname' => $request->input('user_fullname'),
            'password' => bcrypt($request->input('user_password')),
            'role' => 'user',
        ];

        Users::create($data);
        return redirect()
            ->back()
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        Session::flash('user_username', $request->user_username);
        Session::flash('user_fullname', $request->user_fullname);
        Session::flash('user_password', $request->user_password);

        $request->validate(
            [
                'user_fullname' => 'required',
                'user_username' => 'required',
                'user_password' => 'required',
            ],
            [
                'user_fullname.required' => 'Nama lengkap wajib diisi',
                'user_username.required' => 'username wajib diisi',
                'user_password.required' => 'password wajib diisi',
            ]
        );

        $data = [
            'username' => $request->input('user_username'),
            'fullname' => $request->input('user_fullname'),
            'password' => bcrypt($request->input('user_password')),
            'role' => 'user',
        ];

        Users::find($id)->update($data);

        return redirect()
            ->back()
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Users::find($id)->delete();
        return redirect()
            ->back()
            ->with('success', 'User berhasil dihapus');
    }
}
