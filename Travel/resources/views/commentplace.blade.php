@extends('index')
@section('content')

<body> 

  <table class="table table-hover table-bordered responstable example" style="border-collapse:collapse;">
    <h3 style="color: #5a738e;" align="center"> COMMENT MANAGEMENT</h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>ADD COMMENT</button>

    <div>
      @if (Session::has('flash_message01'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message01') !!}
      </div>
      @endif
      @if (Session::has('flash_message02'))
      <div class="alert alert-success form-feedback" role="alert">
        {!! Session::get('flash_message02') !!}
      </div>
    @endif 
    </div>

      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add comment</h4>
            </div>
            <div class="modal-body">
              <form action="/newcommentplace" method="POST" name="formplace" enctype="multipart/form-data"> 
                <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

                  <div class="form-group">
                    <input type="hidden" class="form-control" name="place" value="{{$idplace}}" >
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2">Content:</label>
                    <textarea class="form-control" required="" maxlength="100" name="content"></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="Submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  
              </form>
            </div>
          </div>
          
        </div>
      </div>

    <thead>
      <tr align="center" >
        <th style="text-align: center">ID</th>      
        <th style="text-align: center">Place</th>
        <th style="text-align: center">Content</th>
        <th style="text-align: center">User</th>
        <th style="text-align: center">Time</th> 
        <th style="text-align: center; width: 20%;">Action</th> 
      </tr>
    </thead>

    <tbody>
    @foreach($comment as $item)
    <tr>
     <td>{{$item->idComment}}</td>
     <td>{{$item->place->namePlace}}</td>
     <td>{{$item->content}}</td>
     <td>{{$item->user->nameAccount}}</td>
     <td>{{$item->timeComment}}</td>
     <td>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#{{$item->idComment}}"><i class="fa fa-edit"></i> Edit</button>

      <a href="{{ url('/DeleteCommentPlace/'.$item->idComment) }}" class ="btn btn-danger" 
          onclick="return confirmAction()" ><i class="fa fa-trash-o"></i> Delete
      </a>
     </td>

     <div class="modal fade" id="{{$item->idComment}}" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit comment</h4>
            </div>
            <div class="modal-body">
              <form action="/editcommentplace/{{$item->idComment}}" method="POST" name="formplace" enctype="multipart/form-data"> 
                <input type="hidden" name="_token"  value="{!!csrf_token()!!}">

                  <div class="form-group">
                    <label class="control-label col-sm-2">ID:</label>
                    <input type="text" class="form-control" disabled="disabled" name="place" value="{{$item->idComment}}" >
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-2">Content:</label>
                    <textarea class="form-control" required="" maxlength="100" name="content" value="{{$item->content}}"></textarea>
                  </div>

                  <div class="modal-footer">
                    <button type="Submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  
              </form>
            </div>
          </div>
          
        </div>
      </div>
     </tr>
    @endforeach
    </tbody>

  </table>
</body>
@stop