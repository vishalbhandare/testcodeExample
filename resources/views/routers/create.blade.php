@extends('base')

@section('main')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Router</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('routers.store') }}">
          @csrf
          <div class="form-group">    
              <label for="sapid">Sap ID:</label>
              <input type="text" class="form-control" name="sapid"/>
          </div>

          <div class="form-group">
              <label for="hostname">Host Name:</label>
              <input type="text" class="form-control" name="hostname"/>
          </div>

          <div class="form-group">
              <label for="loopback">Loop Back:</label>
              <input type="text" class="form-control" name="loopback"/>
          </div>
          <div class="form-group">
              <label for="mac_address">Mac Address:</label>
              <input type="text" class="form-control" name="mac_address"/>
          </div> 
          <div class="form-group">
              <label for="type">Type:</label>
              <select class="form-control" id="type">
                <option>AG1</option>
                <option>CSS</option>
              </select>
          </div>                           
          <button type="submit" class="btn btn-primary">Add Router</button>
      </form>
  </div>
</div>
</div>
@endsection