<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stat;

class Stats extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', ['stats' => Stat::latest()->get()]);
    }

    /**
     * Display a graph listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function graphs()
    {
        return view('graphs', ['stats' => Stat::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Stat $stat )
    {
        $input['name'] = request('name');
        $input['data'] = request('data');
        $id = Stat::insertGetId( $stat->init( $input ) );
        return redirect( "/stats/$id" );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stat $stat)
    {
        return view( 'show', ['data' => $stat] );
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
    public function destroy(Stat $stat)
    {
        $stat->delete();
        return redirect( '/' );
    }
}
