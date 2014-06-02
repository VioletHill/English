var words; //所有的word
var wordsCount; //所有的词语数量
var pageItem = 10; //每一页显示的数量
var pageIndex; //现在在第几页
var totalPage; //一共多少页

function addItemWord(word) {
    var wordDiv = $("<div class='wordCell'></div > ");
    var wordTitleSpan = $("<span class='wordTitle'></span>");
    wordTitleSpan.html(word.name);

    var wordVoice = $("<button class='wordVoice' word='" + word.name + "' onclick='readWord(this)'></button >");

    var wordTrans = $("<span class='wordMeaning'></span>");
    wordTrans.html(word.trans);

    wordDiv.append(wordTitleSpan);
    wordDiv.append(wordVoice);
    wordDiv.append(wordTrans);
    $("#wordContainer").append(wordDiv);
}

function clearAllItemWord() {
    $(".wordCell").remove();
}

$(document).ready(function() {
    $.get("getMemorizeWord.php", function(data) {
        words = data;
        wordsCount = data.length;
        totalPage = Math.floor((wordsCount - 1) / pageItem);
        getPageWord(0);
    }, "json");
});


function getPageWord(index) {
    clearAllItemWord();
    pageIndex = index;
    for (var i = index * pageItem; i < (index + 1) * pageItem; i++) {
        if (i >= wordsCount) break;
        addItemWord(words[i]);
    }
}

function getLastPage() {
    console.log(pageIndex);
    if (pageIndex <= 0) {
        alert("已经是最后一页啦");
        return;
    }
    getPageWord(pageIndex - 1);
}

function getNextPage() {
    if (pageIndex >= totalPage) {
        alert("已经是最后一页啦~~");
        return;
    }
    getPageWord(pageIndex + 1);
}

function readWord(obj) {
    word = $(obj).attr("word");

    url = "voice/" + word + ".mp3";
    //url = "voice/1.mp3"; //for test

    myAudio = new Audio(url);
    myAudio.loop = false;
    myAudio.play();

}