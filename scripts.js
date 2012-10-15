
function bulge(nm,wh,action) {

	var nxt = nm + 1;
	
	if ((nm == 2) && (action == 'dn')) { document.getElementById('bttn_' + wh).style.zIndex = '1'; }
	else if ((nm == 2) && (action == 'up')) { document.getElementById('bttn_' + wh).style.zIndex = '2'; }
	
	if (action == 'dn') { var oper_size = (0-(2*nxt)); var oper_pos = nxt; }
	if (action == 'up') { var oper_size = (2*nxt); var oper_pos = (0-nxt); }
	
	document.getElementById('bttn_' + wh).style.left = (parseInt(document.getElementById('bttn_' + wh).style.left)+oper_pos) + "px";
	document.getElementById('bttn_' + wh).style.top = (parseInt(document.getElementById('bttn_' + wh).style.top)+oper_pos) + "px";
	document.getElementById('bttn_' + wh).style.width = (parseInt(document.getElementById('bttn_' + wh).style.width)+oper_size) + "px";
	document.getElementById('bttn_' + wh).style.height = (parseInt(document.getElementById('bttn_' + wh).style.height)+oper_size) + "px";

	if (nm < 3) { var t = setTimeout("bulge("+ nxt +",'" + wh + "','" + action + "');",33); }
}

function shrink_bg(nm,wh) {

	var num_w = 800 - (40 * nm);
	var num_h = 600 - (30 * nm);
	var num_lft = 1 + (20 * nm);
	var nxt = nm + 1;
	
	document.getElementById('main_bg').style.width = num_w + "px";
	document.getElementById('main_bg').style.height = num_h + "px";
	document.getElementById('main_bg').style.left = num_lft + "px";
	
	if (nm < 20) { var t = setTimeout("shrink_bg("+ nxt +",'" + wh + "');",50); }
	else { location = "alb.php?ref=" + wh + "&nm=1"; }
}
