function showtab(btnid,tabid,tabnumber)
{
	for (i = 1;i<=tabnumber;i++)
	{
		document.getElementById(tabid+"_btn"+i).className = "";
		document.getElementById(tabid+"_sub"+i).className = "hide";
	}
	document.getElementById(tabid+"_btn"+btnid).className = "current";
	document.getElementById(tabid+"_sub"+btnid).className = "";
}