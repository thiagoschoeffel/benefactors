<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login')->withViewData(['debug' => 'payload returned successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email:filter',
            'password' => 'required',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não tem um formato válido.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        $loginCheck = \Illuminate\Support\Facades\Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        );

        if (!$loginCheck) {
            return back()->withErrors(['email' => 'Credenciais inválidas']);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard.index');
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
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        \Illuminate\Support\Facades\Auth::logout();

        return redirect()->route('login.create');
    }
}