$(document).ready(function() {
    setRank();
    $(".rightContainer").css({
        opacity: 0
    });
});

function setRank() {
    var name = $(".rankBox").attr("selfName");

    $.get("GetUsersRank.php", function(data) {
        for (var i = 0; i < data.length; i++) {
            if (i < 3) {
                var domId = "rank" + (i + 1);
                $("#" + domId).find(".rankName").html(data[i]);
                if (data[i] == name) {
                    $("#" + domId).find(".rankName").addClass('rankSelf');
                }
            } else if (i >= 8) {
                var div = $('<div class="rankItem" style="text-align:center">' + '......' + '</div>');
                $(".rankPerson").append(div);
                break;
            } else {
                var div = $('<div class="rankItem"></div>');
                var numSpan = $('<span class="rankNumber">' + (i + 1) + '</span>');
                var nameSpan = $('<span class="rankNumberName">' + data[i] + '</span>');
                if (data[i] == name) {
                    $(nameSpan).addClass('rankSelf');
                    $(numSpan).addClass('rankSelf');
                }
                div.append(numSpan);
                div.append(nameSpan);
                $(".rankPerson").append(div);
            }
        }
    }, "json");


}

function showRightContainer() {
    $(".rightContainer").animate({
        opacity: 1
    }, 1000);
}

function hideRightContainer() {
    $(".rightContainer").animate({
        opacity: 0
    }, 1000);
}

function toggleRightContainer() {
    $(".rightContainer").stop();
    var opacity = $(".rightContainer").css("opacity");
    if (opacity == 0) {
        showRightContainer();
    } else {
        hideRightContainer();
    }
}