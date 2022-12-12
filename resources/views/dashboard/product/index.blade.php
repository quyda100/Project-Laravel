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
                    <a href={{route('dashboard.product.create')}} class="btn btn-success btn-create" style="margin-bottom: 1em">Tạo mới</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả</th>
                                <th>Loại Sản Phẩm</th>
                                <th>Chức năng</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Mã Sản Phẩm</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả</th>
                                <th>Loại Sản Phẩm</th>
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
            url: "api/products",
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.length > 0){
                    $.each(response, function (indexInArray, value) { 
                         $('#table-data').append(
                            '<tr>'+
                                '<td>'+value.id+'</td>'+
                                '<td>'+value.SKU+'</td>'+
                                '<td>'+value.Name+'</td>'+
                                '<td>'+value.Price+'</td>'+
                                '<td>'+value.Stock+'</td>'+
                                '<td>'+value.ProductImage+'</td>'+
                                '<td>'+value.description+'</td>'+
                                '<td>'+value.Category+'</td>'+
                                '<td><a href="./product/edit/'+value.id+'" class="btn btn-primary btn-edit" >Sửa </a>'+
                                '<button class="btn btn-danger btn-delete" value="'+value.id+'">Xóa </button> </td>'+
                            '</tr>'
                         );
                    });
                }
            }
        });
        $(document).on('click','.btn-delete',function(){
            var val = $(this).val();
            if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
                $.ajax({
                type: "delete",
                url: "api/products/"+val,
                dataType: "json",
                success: function (response) {
                    if (response) {
                        cuteToast({
                            type: 'success',
                            title:'Thông Báo',
                            message:'Xóa sản phẩm thành công',
                            timer: 2000
                    });
                    location.reload();
                }
                        else{
                            cuteToast({
                            type: 'error',
                            title:'Thông Báo',
                            message:'Xóa sản phẩm không thành công',
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