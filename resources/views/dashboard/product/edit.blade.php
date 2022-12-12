@extends('layouts.dashboard')
@section('content')
<div class="row" style="margin-left: 5em">
    <div class="col-md-4">
    <form id='form-content'>
        @csrf
        <input type="hidden" value="{{$id}}" name="id" id="id">
        <div class="form-group">
            <label class="control-label" for="SKU">Mã sản phẩm</label>
            <input required class="form-control" type="text" id="SKU" name="SKU">
            <span id="errorSKU" class="text-danger error-msg"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="name">Tên sản phẩm</label>
            <input required class="form-control" type="text" name="name" id="name">
            <span id="errorName" class="text-danger error-msg"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="price">Giá tiền:</label>
            <input required class="form-control" type="number" name="price" id="price">
            <span id="errorPrice" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="stock">Số lượng:</label>
            <input required class="form-control" type="number" name="stock" id="stock">
            <span id="errorStock" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="description">Mô tả</label>
            <input required class="form-control" type="text" name="description" id="description">
            <span id="errorDescription" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="category">Loại</label>
            {{-- <input class="form-control" type="category" name="category" id="category"> --}}
            <select class="form-control" name="category" id="category">
                <option value="1">Jordan</option>
                <option value="2">Running</option>
                <option value="3">Basketball</option>
                <option value="4">Football</option>
            </select>
        </div>
        <div class="form-group">
            <input class="form-control btn-success" id="submit" type="submit" value="Cập nhật tài khoản" >
        </div>
    </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var aa = $('#id').val();
        $.ajax({
            type: 'GET',
            url: '../../api/products/'+aa,
            
            dataType: 'json',
            success: function(response)
            {
                $('#SKU').val(response.SKU);
                $('#name').val(response.Name);
                $('#price').val(response.Price);
                $('#stock').val(response.Stock);
                $('#description').val(response.description);
            }
        });
        $('#submit').click(function(e){
            e.preventDefault();
         
            var aa = $('#id').val();
            var data = $('#form-content').serialize();
            console.log(data);
            $.ajax({
                type: 'PUT',
                url: '../../api/products/'+aa,
                data: data,
                dataType: 'json',
                success: function (data) {
                    $('.error-msg').html('');
                    if(data==1){
                        cuteToast({
                            title: "Thông báo",
                            type: "success",
                            message: "Cập nhật sản phẩm thành công",
                            timer: 3000,
                        })
                        // window.setTimeout(function () {
                        //     $('#form-content').trigger('reset');
                        //     window.location.href = "./account";//chuyen huong trang "route" 
                        // }, 1000);
                    }
                    else {
                        cuteToast({
                            title: "Thông báo",
                            type: "error",
                            message: "Cập nhật sản phẩm không thành công",
                            timer: 3000,
                        });
                        return;
                    }
                },
                error : function(data){
                    $('.error-msg').html('');
                        if(data.responseJSON.errors){
                $('.error-msg').css('display','block');
                $('.error-msg').css('text-align','left');
                    $('#errorSKU').text(data.responseJSON.errors.SKU);
                    $('#errorName').text(data.responseJSON.errors.Name);
                    $('#errorPrice').text(data.responseJSON.errors.Price);
                    $('#errorStock').text(data.responseJSON.errors.Stock);
                    $('#errorDescription').text(data.responseJSON.errors.Description);
                }
        }
            })
        })
    </script>
    
@endsection