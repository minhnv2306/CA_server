@if(session()->has('messages'))
    <script>
        toastr.success('{{session('messages')}}');
    </script>
@endif
@if(session()->has('errors'))
    <script>
        toastr.error('Thao tác chưa thành công');
    </script>
@endif