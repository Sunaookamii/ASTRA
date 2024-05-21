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
});