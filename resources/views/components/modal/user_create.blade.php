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
<div class="modal fade" id="create-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open([
            'route' => 'users.store',
            'method' => 'POST',
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
                    <input type="text" class="form-control" id="usr" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Name:</label>
                    <input type="text" class="form-control" id="pwd" name="name">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="text" class="form-control" id="pwd" name="password">
                </div>
                <div class="form-group">
                    <label for="pwd">Retype password:</label>
                    <input type="text" class="form-control" id="pwd" name="password_confirmation">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Tạo</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>