$(".wordPlanDiv").ready(function() {
    $(".wordPlanItem").click(function() {
        clickPlan($(this));
    });
});


function changeSrc2On(src) {
    return src.replace(/off/, "on");
}

function changeSrc2Off(src) {
    return src.replace(/on/, "off");
}

function getDictionaryData(name) {
    $.get("PlanSelect.php", {
            "Dictionary": name
        },
        function(data) {
            resetNavWithUser(data);
        }, "json"
    );
}

function clickPlan(obj) {
    //change select image 
    var src = obj.attr("src");
    obj.attr("src", changeSrc2On(src));

    //connect with server to get the data using dictionary name
    var key = obj.attr("key");
    getDictionaryData(key);


    // change all image but not inlcude select item
    var allObj = $(".wordPlanItem").not(obj);
    for (var i = 0; i < allObj.length; i++) {
        var unselectObj = $(allObj[i]);
        var unSelectSrc = unselectObj.attr("src");
        unselectObj.attr("src", changeSrc2Off(unSelectSrc));
    }

}

function setDefaultClick(dictionaryName) {
    var allObj = $(".wordPlanItem");
    for (var i = 0; i < allObj.length; i++) {
        var obj = $(allObj[i]);
        var key = obj.attr("key");
        var src = obj.attr("src");
        if (key == dictionaryName) {
            obj.attr("src", changeSrc2On(src));
            break;
        }
    }

}