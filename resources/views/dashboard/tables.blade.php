@extends('layouts.dashboard')
@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Quản lý tài khoản</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tài Khoản</h6>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <a href={{route('dashboard.account.create')}} class="btn btn-success btn-create" style="margin-bottom: 1em">Tạo mới</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                        <tbody id="table-data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

    <!-- Page level custom scripts -->
    @section('scripts')
    <script>
        $('#table-data').html('');
        $.ajax({
            type: "GET",
            url: "api/users",
            dataType: "json",
            success: function (response) {
                if(response.length > 0){
                    $.each(response, function (indexInArray, value) { 
                         $('#table-data').append(
                            '<tr>'+
                                '<td>'+value.FullName+'</td>'+
                                '<td>'+value.Email+'</td>'+
                                '<td>'+value.Address+'</td>'+
                                '<td>'+value.Phone+'</td>'+
                                '<td><button class="btn btn-primary btn-edit" value="'+value.id+'">Sửa </button>'+
                                '<button class="btn btn-danger btn-delete" value="'+value.id+'">Xóa </button> </td>'+
                            '</tr>'
                         );
                    });
                }
            }
        });
        $(document).on('click','.btn-delete',function(){
            var val = $(this).val();
            if (confirm("Bạn có chắc muốn xóa tài khoản này?")) {
                $.ajax({
                type: "delete",
                url: "api/users/"+val,
                dataType: "json",
                success: function (response) {
                    if (response) {
                        cuteToast({
                            type: 'success',
                            title:'Thông Báo',
                            message:'Xóa tài khoản thành công',
                            timer: 2000
                    });
                    location.reload();
                }
                        else{
                            cuteToast({
                            type: 'error',
                            title:'Thông Báo',
                            message:'Xóa tài khoản không thành công',
                            timer: 2000
                            });
                        }
                }
            });
            }
        })
    </script>

    <script src="{{asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
    {{-- <script src="{{asset("js/demo/datatables-demo.js")}}"></script> --}}
    @endsection