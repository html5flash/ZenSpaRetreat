// JavaScript Document
var xmlHttp
var aflag="";
function country_sel(cat,id,cond,divs)
{ 
 showdiv=divs;
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 } 
var url="ajaxdata.php"
url=url+"?cat="+cat+"&sta="+cond
url=url+"&id="+id
if(showdiv=="countrytopdiv"){
url=url+"&super="+showdiv
}
if(showdiv=="moviesticketdiv"){
	if(document.getElementById('str_date').value==""){document.getElementById('str_date').focus(); return false;}
	tick1=document.getElementById('str_date').value+"@"+document.getElementById('ed_date').value;
	tick=tick1.split("@");
url=url+"&tik="+tick
}
url=url+"&cond="+cond
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function country_sel_1(cat,id,cond,divs)
{ 
 showdiv=divs;
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 } 
var url="ajaxdata_1.php"
url=url+"?cat="+cat+"&sta="+cond
url=url+"&id="+id
if(showdiv=="countrytopdiv"){
url=url+"&super="+showdiv
}
if(showdiv=="moviesticketdiv"){
	if(document.getElementById('str_date').value==""){document.getElementById('str_date').focus(); return false;}
	tick1=document.getElementById('str_date').value+"@"+document.getElementById('ed_date').value;
	tick=tick1.split("@");
url=url+"&tik="+tick
}
url=url+"&cond="+cond
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function stateChanged() 
{
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  //alert(xmlHttp.responseText)
  //alert(showdiv);
document.getElementById(showdiv).innerHTML=xmlHttp.responseText
  if(showdiv=="countrytopdiv"){
 window.location.reload();
	 }
 } else  //if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
	  document.getElementById(showdiv).innerHTML='<img src="images/ajaxload.gif" alt="Loading Please Wait">'
	  
 }
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try {  xmlHttp=new XMLHttpRequest(); }catch (e) { try  {  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");  } catch (e)  {  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");  } }return xmlHttp;
}