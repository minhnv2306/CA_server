<!-- Modal -->
<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open([
            'route' => 'users.store',
            'method' => 'POST',
            'id' => 'create-user-form'
        ]) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Tạo người dùng mới</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group">
                    <label for="sel1">Nơi làm việc:</label>
                    <select class="form-control" name="work" id="role_id" required>
                        @foreach(\App\User::getAllWork() as $work)
                            <option value="{{$work}}">{{$work}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Quyền:</label>
                    <select class="form-control" name="role_id" id="role_id" required>
                        @foreach(\App\Role::getAllRole() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu:</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Nhập lại mật khẩu:</label>
                    <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="create-user-button">Tạo</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>