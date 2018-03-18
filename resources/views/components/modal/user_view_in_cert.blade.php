<div id="showUser{{$user->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Email:</label>
                    <input type="text" class="form-control" id="usr" value="{{$user->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="pwd">Họ và tên:</label>
                    <input type="text" class="form-control" id="pwd" value="{{$user->name}}" disabled>
                </div>
                <div class="form-group">
                    <label for="pwd">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone_number" disabled value="{{$user->phone_number}}" required>
                </div>
                <div class="form-group">
                    <label for="sel1">Nơi làm việc:</label>
                    <select class="form-control" disabled>
                        @foreach(\App\Models\User::getAllWork() as $work)
                            @if($user->work== $work)
                                <option value="{{$work}}" selected>{{$work}}</option>
                            @else
                                <option value="{{$work}}">{{$work}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Quyền:</label>
                    @if($user->role_id == 2)
                        <h2 class="label label-success">User</h2>
                    @else
                        <h2 class="label label-danger">Admin</h2>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>