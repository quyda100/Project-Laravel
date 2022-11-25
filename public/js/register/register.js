$(document).ready(function(){
    $('#register').click(function(){
        var email = $("#name").val();
        var pass = $("#password").val();
        var fullname = $("#FullName").val();
        var address = $("#Address").val();
        var phone = $("#phone").val();

        // kiem tra truong hop du lieu bo trong 
        // if(email ==""|| pass==""|| fullname==""|| address=="" || phone==""){
        //     //$("#error").html('Vui long dien du thong tin de dang ky tai khoan');

        // }
        // else{
            $.ajax({
                type: "POST",
                url: "api/registerApi",
                data: {
                    email:email,
                    pass:pass,
                    fullname:fullname,
                    address:address,
                    phone:phone,
                },
                
                success: function (response) {
                    // if(response.error!=null){
                    //     //$.each(response.erroor)
                    //     console.log(response.error);
                    // }

                    console.log(1);
                }
            });
        }
    )
});