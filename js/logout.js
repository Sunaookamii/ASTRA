$(function(e){
    $document.on("click","#btnLogout",function(ee){
        $.ajax({
            url:"attendanceapp/ajaxhandler/logoutAjax.php",
            type:"POST",
            dataTyper:"json",
            data:{id:1},
            beforeSend:function(e){

            },
            success:function(e){
                document.location.replace("login.php");
            },
            error:function(e){
                alert("Something went wrong...");
            }
        })
    })
})