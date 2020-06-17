<?php

namespace App\Http\Controllers\API;

use App\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RouterResource;
use Illuminate\Support\Facades\Validator;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->all();
        $router = new Router();
        if (request()->filled('type')) {
            $router = $router->where('type', request()->type);
        }
        if (request()->filled('sapid')) {
            $router->where('sapid', request()->sapid);
        }
        $routers = $router->get();
        return response([ 'routers' => RouterResource::collection($routers), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'sapid'=>'required',
            'hostname'=>'required',
            'loopback'=>'required',
            'mac_address'=>'required',
            'type'=>'required'
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $record = Router::where('hostname', $data['hostname'])->where('loopback', $data['loopback'])->get()->count();
        if ($record > 0) {
            return response(['error' => ['hostname, loopback' => 'duplicate'], 'Validation Error - Duplicate records']); 
        }
        $router = new Router($data);
        $router->save();
        return response([ 'router' => $router, 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        return response([ 'router' => $router, 'message' => 'Retrieved successfully'], 200);
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
        $router->update($request->all());
        return response([ 'router' => $router, 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update by Ip Address
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function updateByIpAddress(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'sapid'=>'required',
            'hostname'=>'required',
            'loopback'=>'required',
            'mac_address'=>'required',
            'type'=>'required'
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $data['mac_address'] = converToStoreMacAddress($data['mac_address']);
        $routers = Router::where('loopback', $request->loopback)->update($data);
        return response([ 'router' => $routers, 'message' => 'Updated successfully'], 200);
    }

    public function getRoutersByIpRange(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'ipStart'=>'required',
            'ipEnd'=>'required'
        ]);
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $ipStart = $data['ipStart'];
        $ipEnd = $data['ipEnd'];

        $collections = DB::table('routers')->whereRaw('INET_ATON(`loopback`) BETWEEN INET_ATON("'.$ipStart.'") AND INET_ATON("'.$ipEnd.'")')->get();
        return response([ 'router' => $collections, 'message' => 'Fetched successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $router = Router::find($id);
        if (empty($router)) {
            return response(['message' => 'Not found'], 404);
        }
        $router->delete();
        return response(['message' => 'Deleted']);
    }

    public function deleteByIpAddress(Request $request)
    {
        $routers = Router::where('loopback', $request->ipAddress)->delete();
        return response(['message' => 'Deleted', 'records' =>  $routers]);
    }
}
