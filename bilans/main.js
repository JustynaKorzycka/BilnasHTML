
var todayDate = new Date();
var todayDay = todayDate.getDay();
var todayMonth = todayDate.getMonth()+1;
var todayYear = todayDate.getFullYear();


function currentMonth()
{
    if (todayMonth<10)todayMonth = "0"+todayMonth;
    document.getElementById("todayMonth").innerHTML ="Bilans finansowy od dnia 01."+todayMonth+"."+todayYear;

}
function lastMonth()
{
    if (todayMonth == 1) todayMonth = 12;
    else if (todayMonth<10)
    {
        todayMonth = todayMonth-1;
        todayMonth = "0"+todayMonth;
    }
    else  todayMonth = todayMonth-1;
    document.getElementById("todayMonth").innerHTML ="Bilans finansowy od dnia 01."+todayMonth+"."+todayYear;
}
function currentYear()
{
    document.getElementById("todayMonth").innerHTML ="Bilans finansowy od dnia 01.01."+todayYear;

}

