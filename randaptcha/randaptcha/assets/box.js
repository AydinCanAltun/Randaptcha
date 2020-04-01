function get_description()
{
    var data = {
        operation: "get_description"
    };

    $.ajax({
        type: "POST",
        url: "core.php",
        data: {query: data},
        success: function(result){
            document.getElementById("UserCaptchaCode").placeholder = result;
        }
    });

}

function refresh_randaptcha()
{
    document.getElementById("CapCode").src = "draw.php";
    setTimeout(function(){
        get_description();
    }, 100)

}

function verify()
{
    var userAnswer = document.getElementById("UserCaptchaCode").value
    var data = {
        operation: "verify",
        userAnswer: userAnswer
    };

    $.ajax({
        type: "POST",
        url: "core.php",
        data: {query: data},
        success: function(result){
            if(result == "ok"){
                document.getElementById("randaptcha").innerHTML = '<div class="sweet-alert"><div class="icon success animate"> <span class="line tip animateSuccessTip"></span> <span class="line long animateSuccessLong"></span> <div class="placeholder"></div> <div class="fix"></div> </div></div>';
            }else{
                refresh_captcha();
            }
        }
    });


}

