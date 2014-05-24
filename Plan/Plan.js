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
    $.get("../DictionaryTest.php", {
            "Dictionary": name
        },
        function(data) {
            //here just show the data in console
            console.log(data);
            // just alert the first word name , so you need to change code here
            alert(data.Word[0].name);
        }, "json"
    );
}

function clickPlan(obj) {

    //change select image 
    var src = obj.attr("src");
    obj.attr("src", changeSrc2On(src));


    // change all image but not inlcude select item
    var allObj = $(".wordPlanItem").not(obj);
    for (var i = 0; i < allObj.length; i++) {
        var unselectObj = $(allObj[i]);
        var src = unselectObj.attr("src");
        unselectObj.attr("src", changeSrc2Off(src));
    }

    //connect with server to get the data using dictionary name
    var key = obj.attr("key");
    getDictionaryData(key);
}