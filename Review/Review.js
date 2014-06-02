function addItemWord(word) {
    var wordDiv = $("<div class='wordCell'></div > ");
    var wordTitleSpan = $("<span class='wordTitle' onclick='gotoDetailWord(this)'></span>");
    wordTitleSpan.html("· " + word.name);

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
    $.get("getUserMarkWord.php", function(data) {
        clearAllItemWord();
        $.each(data, function(index, val) {
            addItemWord(val);
        });
    }, "json");
});

function gotoDetailWord(obj) {
    var word = $(obj).parent().find(".wordVoice").attr("word");
    console.log(word);
    url = "WordDetail.php?word=" + word;
    window.location = url;
}

function readWord(obj) {
    word = $(obj).attr("word");

    url = "voice/" + word + ".mp3";
    //url = "voice/1.mp3"; //for test

    myAudio = new Audio(url);
    myAudio.loop = false;
    myAudio.play();

}