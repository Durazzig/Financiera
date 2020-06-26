<?php

namespace App\Http\Controllers;


use App\Client;
use App\Imports\ImportExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'name'  => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Client::create([
            'name'  => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        return redirect()->route('clients.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        
        $file = $request->file('file');
        Excel::import(new ImportExcel, $file);
        
        return back()->with('message','Usuarios Importados');
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
        $client = Client::findOrFail($id);
        return view('clients/edit',compact('client'));
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
        $clientData = $request->except('_token');
        Client::where('id','=',$id)->update($clientData);
        $clients = Client::all();
        return view('clients.index',compact('clients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        return $client;
    }
}
