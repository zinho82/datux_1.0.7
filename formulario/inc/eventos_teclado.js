function sin_numeros(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	
	patron =/[A-Za-z]/;

	if(patron.test(String.fromCharCode(charCode)))
	{
		return true;
	}
	else
	{
		if(charCode == 8 || charCode == 32)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}



function solo_numeros(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	
	patron =/[0-9]/;

	if(patron.test(String.fromCharCode(charCode)))
	{
		return true;
	}
	else
	{
		if(charCode == 8)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}