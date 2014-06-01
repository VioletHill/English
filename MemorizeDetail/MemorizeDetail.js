var rightWord;

$(document).ready(function() {
    showWord();
});


function showWord() {
    $.get("MemorizeDetailWord.php", function(data) {

        rightWord = data[0];
        words = getRandomOrder(data);
        setChooseButton(words);
        setTrans(rightWord);
    }, "json");
}


function getRandomOrder(words) {
    for (var i = 0; i < words.length; i++) {
        var random = parseInt(Math.random() * words.length);
        var temp = words[i];
        words[i] = words[random];
        words[random] = temp;
    }
    return words;
}

function setChooseButton(words) {
    var chooseButton = $(".chooseButton");
    chooseButton.html("");
    for (var i = 0; i < chooseButton.length; i++) {
        if (i >= words.length) return;
        var button = $(chooseButton[i]);
        button.html(words[i].name);
    }
}

function setTrans(word) {
    var pre = $(".transContainer").find("pre");
    var trans = word.trans.split(";");
    var html = "";
    for (var i = 0; i < trans.length; i++) {
        html = html + trans[i] + '\n\n';
    }
    pre.html(html);
}

function selectWord(obj) {
    var selectWordName = $(obj).html()
    if (selectWordName == rightWord.name) {
        console.log("right");
        goToNextWord();
    } else {
        alert("错误");
    }
}

function goToNextWord() {
    $.get("goToNextWord.php", function(data) {
        console.log(data.finish);
        if (data.finish == "finish") {
            alert("恭喜你 背完了所有单词");
        } else {
            showWord();
            resetNavWithUser(data);
        }
    });
}