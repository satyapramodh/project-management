// JavaScript Document

function validateRegNo(val){
  var len = val.length;
  var first = val.substring(0,2);
  var second = val.substring(2,5);
  var third = val.substring(5,9);
  if(len==9) { 
	if(isNumeric(first) && isAlphanumericAct(second) && isNumeric(third)){
		//alert("Valid Registration Number");
		return true;
	}
	else{
		alert("Invalid Registration Number");
		return false;
	}
  }
  else{
	alert("Invalid Registration Number");
	return false;
  }
}
 
  function isNumeric(elem){
	var numericExpression = /^[0-9]+$/;
	if(elem.match(numericExpression)){
		return true;
	}else{
		//elem.focus();
		return false;
	}
  }
  function isAlphanumericAct(elem){
    var alphaExp = /^[0-9a-zA-Z]+$/;
    if(elem.match(alphaExp)){
        return true;
    }else{
        return false;
    }
  }


