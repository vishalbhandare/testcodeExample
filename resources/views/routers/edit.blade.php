@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Update a Router</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('routers.update', $router->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group">

                <label for="sapid">Sap ID:</label>
                <input type="text" class="form-control" name="sapid" value={{ $router->sapid }} />
            </div>

            <div class="form-group">
                <label for="hostname">Host Name:</label>
                <input type="text" class="form-control" name="hostname" value={{ $router->hostname }} />
            </div>

            <div class="form-group">
                <label for="loopback">Loop Back:</label>
                <input type="text" class="form-control" name="loopback" value={{ $router->loopback }} />
            </div>
            <div class="form-group">
                <label for="mac_address">Mac Address:</label>
                <input type="text" class="form-control" name="mac_address" value={{ $router->mac_address }} />
            </div>
            <div class="form-group">
              <label for="type">Type:</label>
              <select class="form-control" name="type">
                <option {{ $router->type == 'AG1'? 'selected' : '' }}>AG1</option>
                <option  {{ $router->type == 'CSS'? 'selected' : '' }}>CSS</option>
              </select>
          </div> 
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection