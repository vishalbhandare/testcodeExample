<table class="table table-striped" id="dataOutput">
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