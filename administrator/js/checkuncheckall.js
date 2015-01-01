function checkAlluncheckAll(FormName, FieldName)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(document.getElementById('check').checked==true)
	{
	if(!countCheckBoxes)
		objCheckBoxes.checked = true;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = true;
	}
	else
	{
	    if(!countCheckBoxes)
		objCheckBoxes.checked = false;
		else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = false;
	}
}