<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('basic.list', [
    //         'title' => 'User List',
    //         'users' => User::paginate(10)
    //     ]);
    // }

    public function index(Request $request)
    {
        $query = \App\User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return view('basic.list', [
            'title' => 'Data Users',
            'users' => $users,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('basic.create', [
            'title' => 'New User',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('basic.index')->with('message', 'User added successfully!');
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
    public function edit(User $basic)
    {
        return view('basic.edit', [
            'title' => 'Edit User',
            'user' => $basic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $basic)
    {
        if($request->filled('password')) {
            $basic->password = Hash::make($request->password);
        }
        $basic->name = $request->name;
        $basic->last_name = $request->last_name;
        $basic->email = $request->email;
        $basic->kelas = $request->kelas;
        $basic->save();

        return redirect()->route('basic.index')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $basic)
    {
        if (Auth::id() == $basic->getKey()) {
            return redirect()->route('basic.index')->with('warning', 'Can not delete yourself!');
        }

        $basic->delete();

        return redirect()->route('basic.index')->with('message', 'User deleted successfully!');
    }

    public function pemilih($id)
    {
        $user = User::findOrFail($id);
        $user->jenis = 2;
        $user->save();
        return redirect()->route('basic.index')->with('success', 'User updated as Pemilih.');
    }

    public function kesiswaan($id)
    {
        $user = User::findOrFail($id);
        $user->jenis = 3;
        $user->save();
        return redirect()->route('basic.index')->with('success', 'User updated as Kesiswaan.');
    }

}
