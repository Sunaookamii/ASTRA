function tryLogin(){
    let un=$("txtUsername").val();
    let pw=$("txtPassword").val();
    if(un.trim()!=="" && pw.trim() !==""){
        // ajax call
        $.ajax({
            url:"ajaxhandler/loginAjax.php",
            type:"POST",
            dataType:"json",
            data:{user_name:un, password:pw, action:"verifyUser"},
            beforesend: function(){
                //alert("about to make an ajax call");
            },
            success: function(rv){
                if(rv['status']=="OKAY"){
                    document.location.replace("attendace.php");
                } else{
                    alert(rv['status'])
                }
            },
            error: function(){},
        })
    }
}
$(function(e){
    $(document).on("keyup","input", function(e){
        let un=$("txtUsername").val();
        let pw=$("txtPasword").val();
        if(un.trim()!=="" && pw.trim() !=="") {
            $("#btnlogin").removeClass("inactivecolor");
            $("#btnlogin").addClass("activecolor");
        }
        else {
            $("#btnlogin").removeClass("activecolor");
            $("#btnlogin").addClass("inactivecolor");
        }

    });
    $(document).on("click", "#btnLogin", function(e){
        tryLogin();
    })
});