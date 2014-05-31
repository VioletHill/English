    $(window).ready(function() {

        $(".tabButton").click(function() {
            {
                //if this is already select
                if ($(this).hasClass('tabButtonSelect')) return;

                $(".tabButton").toggleClass('tabButtonSelect');
                $(".tabButton").toggleClass('tabButtonUnselect');

                changeForm();
            }
        });
    });

    function changeForm() {
        if ($(".loginButton").hasClass('tabButtonSelect')) {
            $(".registerForm").fadeOut(500, function() {
                $(".loginForm").fadeIn(500);
            });
        } else {
            $(".loginForm").fadeOut(500, function() {
                $(".registerForm").fadeIn(500);
            });
        }
    }

    function getFocus($nextObj) {
        $nextObj.focus();
    }

    function loginFormKeyDown(event) {
        if (event.keyCode == 13) {
            var focusID = $(":focus").attr("id");
            if (focusID == "loginName") {
                getFocus($("#loginPassword"));
            } else if (focusID == "loginPassword") {
                loginButtonClick();
            }
        }
    }

    function registerFormKeyDown(evnet) {
        if (event.keyCode == 13) {
            var focusID = $(":focus").attr("id");
            if (focusID == "registerName") {
                getFocus($("#registerPassword"));
            } else if (focusID == "registerPassword") {
                getFocus($("#registerPasswordConfirm"));
            } else if (focusID == "registerPasswordConfirm") {
                loginButtonClick();
            }
        }
    }


    //when login, password is wrong will call this function 

    function shake($obj) {
        w = 100;
        for (var i = 1; i < 9; i++) {
            $obj.animate({
                left: (w - (w / 8) * i) * ((i % 2 === 0) ? 1 : -1)
            }, 50 - (i * i));
        }
    }

    //submit the form

    var isSubmit = false;

    function loginButtonClick() {

        var userName = $('#loginName').attr("value");
        var password = $('#loginPassword').attr("value");
        if (password == "" || userName == "") {
            shake($(".formContainer"));
            return;
        }

        try {
            password = $.md5(password);
        } catch (e) {
            shake($(".formContainer"));
            return;
        }

        if (isSubmit) {
            alert("login in...., please wait");
            return;
        }
        isSubmit = true;

        $.ajax({
            url: 'login.php',
            type: 'post',
            dataType: 'json',
            data: {
                "account": userName,
                "password": password,
            },
            success: function(data) {
                if (data.success == false) {
                    shake($(".formContainer"));
                } else {
                    //edit code here
                    window.location = "choose.php";
                }
                isSubmit = false;
            },
            error: function(msg) {
                console.log(msg);
                alert(" network fail, please try again ");

                isSubmit = false;
            }
        });
    }

    function registerButtonClick() {

        var userName = $("#registerName").attr("value");
        var password = $("#registerPassword").attr("value");
        var passwordConfirm = $("#registerPasswordConfirm").attr("value");
        if (!isRegisterUserName(userName)) {
            alert("user name only support char and number betweent 5 to 15 letters");
            return;
        }
        if (password.length < 5 || password.length > 15) {
            alert("password's length must between 5 to 15 letters");
            return;
        }

        if (password != passwordConfirm) {
            alert("password and confirm are different");
            return;
        }

        if (isSubmit) {
            alert("the form is submiting, please wait");
            return;
        }
        isSubmit = true;

        var md5Password = $.md5(password);
        $.ajax({
            url: 'Register.php',
            type: "post",
            dataType: 'json',
            data: {
                "account": userName,
                "password": md5Password
            },
            success: function(data) {
                console.log(data);
                if (data.success == false) {
                    alert(data.msg);
                } else {
                    alert("congratulation!register complete ");
                }
                isSubmit = false;
            },
            error: function(msg) {
                console.log(msg);
                alert(" network fail, please try again ");

                isSubmit = false;
            }
        });
    }

    function isRegisterUserName(s) {
        var patrn = /^[a-zA-Z][a-zA-Z0-9_]{4,15}$/;
        if (!patrn.exec(s)) return false;
        return true;
    }