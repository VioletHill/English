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