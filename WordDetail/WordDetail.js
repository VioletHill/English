$(document).ready(function() {

    var word = $(".transContainer").find("pre").html();
    setTrans(word);
});

function setTrans(word) {
    var pre = $(".transContainer").find("pre");
    var trans = word.split(";");
    var html = "";
    for (var i = 0; i < trans.length; i++) {
        html = html + trans[i] + '\n\n';
    }
    pre.html(html);
}

function readWord() {
    word = $(".wordName").html();
    url = "voice/" + word + ".mp3";
    myAudio = new Audio(url);
    myAudio.loop = false;
    myAudio.play();

}

var isClick = false;

function mark() {
    if (isClick) return;
    isClick = true;
    var word = word = $(".wordName").html();
    $.get("Mark.php", {
        "action": "ask",
        "word": word
    }, function(data) {

        if (data.isExist) {
            if (confirm("该单词在您的生词库里,需要删除吗")) {
                $.get("Mark.php", {
                    "action": "delete",
                    "word": word,
                }, function(data) {
                    alert("该单词已经从生词库中去除");
                    isClick = false;
                }, "json");
            } else isClick = false;
        } else {

            if (confirm("确认添加入生词库吗")) {
                $.get("Mark.php", {
                    "action": "insert",
                    "word": word,
                }, function(data) {
                    alert("成功添加到生词表中");
                    isClick = false;
                });
            } else isClick = false;
        }
    }, "json");
}