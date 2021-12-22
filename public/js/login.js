$("#msg-status").hide()
$("#login-btn").on("click", (e) => {
	let post_data = $("#login-form").serialize()
	$.ajax({
		url: "user/login",
		data: post_data,
		dataType: "json",
		method: "post",
		success: function(response){
			if(response.status){
				window.location.reload()
			}else{
				$("#msg-status").html(response.msg)
				$("#msg-status").show()
			}
		}
	})
	e.preventDefault()
})