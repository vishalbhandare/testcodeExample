<?php

namespace App\Http\Controllers;

use App\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->search($request);
        }
        $routers = $this->_getCollectionFilter($request);
        return view('routers.index', ['routers' => $routers->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('routers.create');
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
            'sapid'=>'required',
            'hostname'=>'required',
            'loopback'=>'required',
            'mac_address'=>'required',
            'type'=>'required'
        ]);

        $router = new Router([
            'sapid' => $request->get('sapid'),
            'hostname' => $request->get('hostname'),
            'loopback' => $request->get('loopback'),
            'mac_address' => $request->get('mac_address'),
            'type' => $request->get('type')
        ]);
        $router->save();
        return redirect('/routers')->with('success', 'Router saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function edit(Router $router)
    {
        return view('routers.edit', compact('router'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Router $router)
    {
        $request->validate([
            'sapid'=>'required',
            'hostname'=>'required',
            'loopback'=>'required',
            'mac_address' => 'required',
            'type' => 'required',
        ]);

        $router->update([
            'sapid' => $request->sapid, 
            'hostname' => $request->hostname, 
            'loopback' => $request->loopback, 
            'mac_address' => $request->mac_address, 
            'type' => $request->type
        ]);
        return redirect('/routers')->with('success', 'Router updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function destroy(Router $router)
    {
        $router->delete();
        return redirect('/routers')->with('success', 'Router deleted!');
    }

    /**
     * Search Result
     *
     */
    public function search(Request $request)
    {
        $routers = $this->_getCollectionFilter($request);  
        $htmlreturn = view('routers.search', ['routers' => $routers->paginate(10)])->render();

        return response()->json(array('success' => true, 'html'=> $htmlreturn));
    }

    private function _getCollectionFilter (Request $request) {
        $routers = DB::table('routers');
        if ($request->filled('sapid')) {
             $routers->where('sapid', 'like', '%'.$request->sapid.'%');
         }
         if ($request->filled('hostname')) {
             $routers->where('hostname', 'like', '%'.$request->hostname.'%');
         }
         if ($request->filled('loopback')) {
             $routers->where('loopback', 'like', '%'.$request->loopback.'%');
         }
         if ($request->filled('mac_address')) {
             $routers->where('mac_address', '=', base_convert(str_replace(':','', $request->mac_address), 16, 10));
         }
         if ($request->filled('type')) {
             $routers->where('type', 'like', '%'.$request->type.'%');
         }
         return $routers;
    }

}
