<!-- Modal -->
<style>
    .form-control {
        width: 100% !important;
    }

    .form-group {
        padding-bottom: 10px;
        width: 100% !important;
    }
</style>
<div class="modal fade" id="user{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open([
            'route' => ['users.update', 'user' => $user->id],
            'method' => 'PUT',
        ]) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Email:</label>
                    <input type="text" class="form-control" id="usr" value="{{$user->email}}" disabled>
                </div>
                <div class="form-group">
                    <label for="pwd">Họ và tên:</label>
                    <input type="text" class="form-control" id="pwd" value="{{$user->name}}" name="name">
                </div>
                <div class="form-group">
                    <label for="pwd">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                           value="{{$user->phone_number}}" required>
                </div>
                <div class="form-group">
                    <label for="sel1">Nơi làm việc:</label>
                    <select class="form-control" name="work">
                        @foreach(\App\Models\User::getAllWork() as $work)
                            @if($user->work== $work)
                                <option value="{{$work}}" selected>{{$work}}</option>
                            @else
                                <option value="{{$work}}">{{$work}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user()->id != $user->id)
                    <div class="form-group">
                        <label for="sel1">Quyền:</label>
                        <select class="form-control" name="role_id">
                            @foreach(\App\Models\Role::getAllRole() as $role)
                                @if($user->role_id == $role->id)
                                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>