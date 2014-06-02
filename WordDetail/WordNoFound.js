$(document).ready(function() {
    var html = '抱歉~~~~~~~~,你搜索的词不存在,<span id="second" style="color:red">3秒</span>后自动跳转回首页<br>如果不能及时跳转，请点击<a href="choose.php">这里</a>';
    $(".errorMsg").html(html);
    setTimeout("setTime()", 1000);
});

function setTime() {
    var number = parseInt($("#second").html());
    if (number == 0) {
        window.location = "choose.php";
    } else {
        $("#second").html(number - 1 + '秒');
    }
    setTimeout("setTime()", 1000);
}