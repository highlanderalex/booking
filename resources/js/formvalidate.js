//Показать форму заказа
function showForm()
{
	var frm = document.getElementById("form_order");
	var btn = document.getElementById("order_button");
	btn.style.display = "none";
	frm.style.display = "block";
}

//Проверка полей формы на пустоту					
function checkForm()
{
	var name = document.getElementById("name");
	var address = document.getElementById("address");
	var qty = document.getElementById("count");
	var captcha = document.getElementById("captcha");
						
	if (!name.value)
	{
		alert("Поле  имя не должно быть пустым!");
		name.className = 'empty';
		name.focus();
		return false;
	}
						
	if (!address.value)
	{
		alert("Поле  адрес не должно быть пустым!");
		address.className = 'empty';
		address.focus();
		return false;
	}
						
	if (!qty.value)
	{
		alert("Поле количество не должно быть пустым!");
		qty.className = 'empty';
		qty.focus();
		return false;
	}
						
	if (!captcha.value)
	{
		alert("Поле код не должно быть пустым!");
		captcha.className = 'empty';
		captcha.focus();
		return false;
	}
						
}

//Подписка на события					
window.onload = function()
{
	var btn = document.getElementById("order_button");
	btn.onclick = showForm;
	var form = document.getElementById("form_order");
	form.onsubmit = checkForm;
}


