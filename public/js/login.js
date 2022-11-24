// BUoc 2

// test hai file php da ket noi duoc voi file js chuya ?
// do sp vao trang 
$(document).ready(function () {
    $("#submit").click(function () {
        var email = $("#name").val();
        // dng focus vao id la email de lay gia tri va gan gia tri cua value cho bien co ten la email
        var pass = $("#password").val();
        if (email == "" || pass == "") {
            //(1) alert 
            //alert('email va password k dc bo trong');
            //(2) console.log
            //console.log('email va password k dc bo trong');
            //(3) $("#error") -> focus vao the co id la error
            $("#error").html('email va password k dc bo trong');
        }
        // buoc 4
        else {
            $.ajax({
                // type pthuc goi
                type: 'POST',
                url: "api/loginApi",
                data: {
                    // email: -> la bien gui du lieu email la du lieu truyen vao bien
                    email: email,
                    pass: pass

                },
                success: function (data) {
                    // data o function vo danh != data{} data o duoi la data nhan khi controller da retuenve value; data tren la truyen value di
                    //console.log(data);
                    // success : du lieu tra ve khi hoan thanh -> va nhan du lieu qua data
                    if (data != -1) {
                        $.session.set('id', '1');
                        console.log($.session.get('id'));
                        cuteToast({
                            title: "Thông báo",
                            type: "success",
                            message: "Đăng nhập thành công",
                            timer: 3000,
                        })
                        window.setTimeout(function () {
                            window.location.href = "/";//chuyen huong trang "route" 
                        }, 1000);

                    }
                    else {
                        cuteToast({
                            title: "Thông báo",
                            type: "error",
                            message: "Sai tài khoản hoặc mật khẩu",
                            timer: 3000,
                        });
                        return;
                    }

                }

            })
        }
    })
})

// moi funtion vo danh se co cac su kien click,...
// $(#) huong den the toi the co gan id ="submit"
// click la su kien click vao the do funtion trong click la su kien xay ra sau khi click




// -> buoc 3 (day du lieu )
