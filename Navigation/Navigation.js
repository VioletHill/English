$(".planNavigation").ready(function() {
    setDate();
});

function setDate() {
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var weekDay = date.getDay();
    var weekDayStr = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $(".navigationDate").html(year + '/' + month + '/' + day + '\t' + weekDayStr[weekDay]);
}

function resetNavWithUser(user) {
    $("#navAccount").html('WELCOME  ' + user.account);
    $("#navDictionary").html(user.dictionaryName);
    $("#navProcess").html(user.process);
}