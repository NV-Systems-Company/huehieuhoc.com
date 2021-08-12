// JavaScript Document
//===Set cookies
function page_load()
{
	set_speaker();
}

function set_speaker()
{
	n = readCookie("speaker");
	if (n==1)
	{
		document.all.nhac_nen.play();
		document.all.img_speaker.src = "images/speaker1.gif";
	}
	else
	{
		document.all.nhac_nen.stop();
		document.all.img_speaker.src = "images/speaker0.gif";
	}	
}

function speaker_click()
{
	n = readCookie("speaker");
	if (n==0)
	{
		writeCookie("speaker", 1, 8);
		document.all.nhac_nen.play();
		document.all.img_speaker.src = "images/speaker1.gif";
	}
	else
		{
		writeCookie("speaker", 0, 8);
		document.all.nhac_nen.pause();
		document.all.img_speaker.src = 'images/speaker0.gif';
	}
}

function readCookie(name)
{
  var cookieValue = "";
  var search = name + "=";
  if(document.cookie.length > 0)
  { 
    offset = document.cookie.indexOf(search);
    if (offset != -1)
    { 
      offset += search.length;
      end = document.cookie.indexOf(";", offset);
      if (end == -1) end = document.cookie.length;
      cookieValue = unescape(document.cookie.substring(offset, end))
    }
  }
  return cookieValue;
}

function writeCookie(name, value, hours)
{
  var expire = "";
  if(hours != null)
  {
    expire = new Date((new Date()).getTime() + hours * 3600000);
    expire = "; expires=" + expire.toGMTString();
  }
  document.cookie = name + "=" + escape(value) + expire;
}

function set_cookies_hideshow_submenu(id_submenu,cookie_name) 
{
	var id   = document.getElementById(id_submenu);
	if (id.style.display =="none")
	{	
		writeCookie(cookie_name, "none", 1);
	}
	else
	{	
		writeCookie(cookie_name, "", 1);
	}
	//alert("Nhap day du thong tin yeu cau");
};

//==============================
function Ovr_td(td,classname) 
{
	td.className = classname;
	//td.style.cursor = 'hand';
};

function Out_td(td,classname) 
{
	td.className = classname;
};

function HideShow(id_name) 
{
	var id   = document.getElementById(id_name);
	if (id.style.display =="none")
	{	
		id.style.display ="";
	}
	else
	{	
		id.style.display ="none";
	}
	//alert("Nhap day du thong tin yeu cau");
};

function Ovr_row(tr) 
{
	tr.className = 'row_content1';
	tr.style.cursor = 'hand';
};

function Out_row(tr) 
{
	tr.className = 'row_content';
};
