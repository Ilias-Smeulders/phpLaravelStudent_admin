<?php

namespace App\Http\Controllers;

use App\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::orderBy('id')->get();
        $result = compact('programmes');
        //dd($result);
        return view('programmes.programmes', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programmes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name'
        ]);

        // Create new programme
        $programme = new Programme();
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', "The programme <b>$programme->name</b> has been added");
        // Redirect to the master page
        return redirect('/programmes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/programmes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        $result = compact('programme');
        //Json::dump($result);
        return view('programmes.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name,' . $programme->id
        ]);

        // Update programme
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', 'The programme has been updated');
        // Redirect to the master page
        return redirect('/programmes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();
        session()->flash('success', "The programme <b>$programme->name</b> has been deleted");
        return redirect('/programmes');
    }
}
