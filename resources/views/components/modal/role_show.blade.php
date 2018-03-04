<!-- Modal -->
<style>
    .form-control {
        width: 100% !important;
    }

    .form-group {
        padding-bottom: 20px;
        width: 100% !important;
    }
</style>
<div class="modal fade" id="role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open([
            'route' => ['roles.update', 'role' => $user->id],
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
                    <label for="pwd">Name:</label>
                    <input type="text" class="form-control" id="pwd" value="{{$role->name}}" name="name">
                </div>
                @foreach($objects as $object)
                    <div class="form-group">
                        <label for="pwd">{{$object->name}}</label>
                        <input type="radio" id="pwd" value="{{$object->name}}" name="status{{$object->id}}" checked> Xem
                        <input type="radio" id="pwd" value="{{$object->name}}" name="status{{$object->id}}"> Chỉnh sửa
                    </div>
                @endforeach
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>