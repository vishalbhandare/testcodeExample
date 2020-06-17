@extends('base')

@section('main')
<div class="row">
    
<div class="col-sm-12">

@if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}  
  </div>
@endif
</div>
<div class="col-sm-12">
    <h1 class="display-3">Routers</h1>   
    <div>
    <a style="margin: 19px;" href="{{ route('routers.create')}}" class="btn btn-primary">New Router</a>
    </div>   
  <div>
    <form class="form-inline" id="searchform">
      <div class="form-group m-2 p-2">
        <label for="formControlRange mr-2">Sap ID &nbsp;</label>
        <input class="form-control" type="text" name="sapid" value="{{request()->sapid}}" placeholder="">
      </div>
      <div class="form-group  m-2 p-2">
        <label for="formControlRange">Host Name &nbsp;</label>
        <input class="form-control" type="text" name="hostname"  value="{{request()->hostname}}" placeholder="">
      </div>
      <div class="form-group  m-2 p-2">
        <label for="formControlRange">LoopBack &nbsp;</label>
        <input class="form-control" type="text" name="loopback" value="{{request()->loopback}}" placeholder="">
      </div>
      <div class="form-group  m-2 p-2">
        <label for="formControlRange">Mac Address &nbsp;</label>
        <input class="form-control" type="text" name="mac_address" value="{{request()->mac_address}}" placeholder="">
      </div>
      <div class="form-group  m-2 p-2">
        <label for="formControlRange">Type &nbsp;</label>
        <select id="inputState" class="form-control"  name="type"  >
          <option value=''>Select</option>
          <option {{request()->type == 'AG1' ? 'selected' : ''}}>AG1</option>
          <option {{request()->type == 'CSS' ? 'selected' : ''}}>CSS</option>
        </select>
      </div>
      <div class="form-group  m-2 p-2">
        <input class="btn btn-primary" type="button" value="Search" id="searchfilter" onclick="getSearchResult()">
        <input class="btn btn-primary ml-3" type="button" value="Reset Filter"  onclick="resetFilter()">
      </div>
    </form>
  </div>  
  <div  id="dataOutput">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Sap ID</td>
          <td>Host Name</td>
          <td>Loop Back</td>
          <td>Mac Address</td>
          <td>Type</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($routers as $router)
        <tr>
            <td>{{$router->sapid}}</td>
            <td>{{$router->hostname}}</td>
            <td>{{$router->loopback}}</td>
            <td>{{formatMacAddress($router->mac_address)}}</td>
            <td>{{$router->type}}</td>
            <td>
                <a href="{{ route('routers.edit',$router->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('routers.destroy', $router->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  
  {{ $routers->appends(request()->query())->links() }}
  </div>
<div>
</div>
<script type="text/javascript">
function getSearchResult () {
  let searchparam = $('#searchform').serialize()
  $.ajax({url: "/routers?" + searchparam, 
    success: function(result){
      $('#dataOutput').html(result.html)
    }
  });
}
function resetFilter () {
    window.location.href = '/routers'
}
</script>
@endsection