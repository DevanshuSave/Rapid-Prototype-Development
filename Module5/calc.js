var list_operators = document.getElementsByName("operator");

function calculate () {
	
	var operator = null;
	for(var i=0; i<list_operators.length; i++){
		 if(list_operators[i].checked){
			 operator = list_operators[i].value;  
			 break;
		}
	}
	var num1 = document.getElementById("num1").value;
	var num2 = document.getElementById("num2").value;
	var ans = "";
	if (num1 == "" || num2 == "") {
			 ans = "Enter correct values in all fields";
			 document.getElementById("ans").textContent = ans;
	} 
	else if (operator == null) {
				ans = "Operator is not selected";
				document.getElementById("ans").textContent = ans;
	} 
	else {
		if(operator== "add"){
			ans = Number(num1) + Number(num2);
			document.getElementById("ans").textContent = "Addition result: "+ ans;
		}
		else if (operator== "sub"){
			ans = num1 - num2;
			document.getElementById("ans").textContent = "Subtraction result: "+ ans;
		}
		else if (operator == "mul"){
			ans = num1 * num2;
			document.getElementById("ans").textContent = "Multiplication result: "+ ans;
		}
		else if (operator=="div"){
			if (num2 == 0) {
				document.getElementById("ans").textContent = "Divide by zero error";
			} 
			else {
				ans = num1 / num2;
				document.getElementById("ans").textContent = "Division result: "+ ans;
			}
		}
		else{}
	}
}

document.getElementById("num1").addEventListener("change",calculate,false);
document.getElementById("num2").addEventListener("change",calculate,false);

for(var i=0; i<list_operators.length; i++) {
	list_operators[i].addEventListener("click",calculate,false);
}