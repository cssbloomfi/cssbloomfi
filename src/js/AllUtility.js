
/*
	Library written by Smritiman Barua 
*/

function SetAllCheckBoxes(FormName,FieldName,callername)
{
	var checkvalue = document.forms[FormName].elements[callername].value;
	if(checkvalue==1){
		document.forms[FormName].elements[callername].value=0;
		CheckValue=false;	
	}
	else {
	       document.forms[FormName].elements[callername].value=1;
	       CheckValue=true;
	}
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}
function multiAjaxCaller(){
	var len=multiAjaxCaller.arguments.length;
	for ( i=0; i<len ; i++ ){
		callajax(multiAjaxCaller.arguments[i][0],multiAjaxCaller.arguments[i][1],multiAjaxCaller.arguments[i][2]); }
}
function callajax(str,id,uri){
	ajaxCalling(str,id,uri,false);}
function callajaxloading(str,id,uri){
	ajaxCalling(str,id,uri,true);}
function callajaxloading2(str,id,uri){
	ajaxCalling(str,id,uri,'main');}
function ajaxCalling(str,id,uri,loadimage){
	var xmlhttp=null;
	if (str=="")
	  {
	  document.getElementById(id).innerHTML="";
	  return;
	  } 
	 if(loadimage==true)
		document.getElementById(id).innerHTML='&nbsp;<img src="/js/loading.gif" alt="" height="17"/>'; 
	 else  if(loadimage=='main')
		document.getElementById(id).innerHTML='<center><img src="/js/ajaxloading.gif" alt="" /></center>'; 

	if (window.XMLHttpRequest)
	  {
	  xmlhttp=new XMLHttpRequest();
		  if (xmlhttp.overrideMimeType)
			  {
			   xmlhttp.overrideMimeType('text/xml');
			 }
	  }
	else if (window.ActiveXObject)
	  {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(id).innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET",uri+"?q="+str,true);
	xmlhttp.send(null);
}
function array(){ return array.arguments; }
function delayRedirect(url){
	 var Timeout = setTimeout("window.location='" + url + "'",2000);}
