
function SC(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
//  document.cookie = cname+"="+cvalue+"; "+expires;
	document.cookie = cname+"="+cvalue+"; "+expires+"; path=/"; 
}
function GC(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function lod(g,p,Li,el){ 
//alert(Li);
if (window.XMLHttpRequest)
  { var ahr = new XMLHttpRequest();
  }
  else // code for IE6, IE5     //***** Need one more else for rest of the BROWSERS*****//
  {  ahr=new ActiveXObject("Microsoft.XMLHTTP");  }
  
 ahr.open('post', Li+'?'+g,true);//ahr.setRequestHeader("Access-Control-Allow-Origin:","d.com");
 ahr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  
ahr.onreadystatechange = function () {
    if (ahr.readyState === 4) { if (ahr.status === 200) { var ar=JSON.parse(ahr.response); 
	if(!ar['cmb_eml'] || ar['cmb_eml'].length==2){} else {SC("cmb_eml", ar['cmb_eml'], 30);SC("cmb_vld", ar['cmb_vld'], 30);SC("cmb_ssn", ar['cmb_ssn'], 30);SC("cmb_nm", ar['cmb_nm'], 30);}

	if(!ar['refresh'] || ar['refresh'].length==2){} else { location.assign(location.href); }
	if(!ar['undefined'] || ar['undefined'].length==2){} else { alert("Your Facebook profile doesn't contain email address, please opt different login method"); }
//document.write(ahr.response);// document.write(ar['doc']);// thats for a FRESH START(DELETE EVERYTHING ON PAGE AND FRESH START)
//var El = document.createElement(ar['ele']); if(ar['id'].length>1)El.id=ar['id'];  if(ar['cls'].length>1)El.className=ar['cls'];
if(!ar['ms'] || ar['ms'].length==0){} else { document.getElementById(el).innerHTML=ar['ms'];
} 
         // Append <button> to <body>
//document.body.appendChild(El); 

//document.body.innerHTML+=ar['doc'];		// TO ADD DOc Bunch of DIVs


 
        } else {
            alert('Connect Error: ' + ahr.status); // An error occurred during the request.
			location.assign(location.href);
        }    }};
 

//ahr.open('post', 'http://d.com/bd.php?'+yy,true);
//
//var t=GC('SD');xx=t+xx;






ahr.send(p);
}