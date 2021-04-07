function changeDate(projectID, date)
{
    if(date.indexOf('-') != -1)
    {
        var datearray = date.split("-");
        var date = '';
        for(i=0 ; i<datearray.length ; i++)
        {
            date = date + datearray[i]; 
        }
    }
    link = createLink('project', 'effort', 'projectID=' + projectID + '&date=' + date);
    location.href=link;
}

function changeUser(projectID, date, userID)
{
    if(date.indexOf('-') != -1)
    {
        var datearray = date.split("-");
        var date = '';
        for(i=0 ; i<datearray.length ; i++)
        {
            date = date + datearray[i]; 
        }
    }
    link = createLink('project', 'effort', 'projectID=' + projectID + '&date=' + date + '&userID=' + userID);
    location.href = link;
}
