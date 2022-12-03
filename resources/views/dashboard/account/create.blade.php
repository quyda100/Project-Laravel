@extends('layouts.dashboard')
@section('content')
<div class="row" style="margin-left: 5em">
    <div class="col-md-4">
    <form id='form-content'>
        @csrf
        <div class="form-group">
            <label class="control-label" for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email">
            <span id="errorEmail" class="text-danger error-msg"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="password">Mật khẩu:</label>
            <input class="form-control" type="password" name="password" id="password">
            <span id="errorPassword" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="FullName">Tên:</label>
            <input class="form-control" type="text" name="FullName" id="FullName">
            <span id="errorFullName" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label class="control-label" for="Address">Địa chỉ:</label>
            <input class="form-control" type="text" name="Address" id="Address">
            <span id="errorAddress" class="text-danger"></span>
        </div>

        <div class="form-group">
            <label class="control-label" for="Phone">Số điện thoại:</label>
            <input class="form-control" type="text" name="Phone" id="Phone">
            <span id="errorPhone" class="text-danger"></span>
            </div>
        <div class="form-group">
            <input class="form-control btn-success" id="submit" type="submit" value="Tạo tài khoản" >
        </div>
    </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $("#submit").click(function (e) { 
        e.preventDefault();
        var form = $('#form-content').serialize()
        $.ajax({
            type: "POST",
            url: "../api/users",
            data: form,
            success: function (data) {
                $('.error-msg').html('');
                if(data==1){
                    cuteToast({
                        title: "Thông báo",
                        type: "success",
                        message: "Tạo tài khoản thành công",
                        timer: 3000,
                    })
                    window.setTimeout(function () {
                        $('#form-content').trigger('reset');
                        window.location.href = "./account";//chuyen huong trang "route" 
                    }, 1000);
                }
                else {
                    cuteToast({
                        title: "Thông báo",
                        type: "error",
                        message: "Tạo tài khoản không thành công",
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
                $('#errorEmail').text(data.responseJSON.errors.email);
                $('#errorPassword').text(data.responseJSON.errors.password);
                $('#errorFullName').text(data.responseJSON.errors.FullName);
                $('#errorAddress').text(data.responseJSON.errors.Address);
                $('#errorPhone').text(data.responseJSON.errors.Phone);
            }
        }
        });
    });
    </script>
@endsection