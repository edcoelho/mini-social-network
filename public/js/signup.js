$("#msg-status").hide()
$("#signup-btn").on("click", (e) => {
	let post_data = $("#signup-form").serialize()
	$.ajax({
		url: "user/signup",
		data: post_data,
		dataType: "json",
		method: "post",
		success: function(response){
			if(response.status){
				window.location.href = "./";
			}else{
				$("#msg-status").html(response.msg)
				$("#msg-status").show()
			}
		}
	})
	e.preventDefault()
})