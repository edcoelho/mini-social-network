$(document).ready(() => {
    function getPosts(){
        $.ajax({
            url: "cleck/get",
            data: "offset=" + $(".post").length,
            dataType: "html",
            method: "get",
            success: function(response){
                $("#posts-box").append(response)
            }
        })
    }
    getPosts();
    $(window).scroll(() => {
        if($(window).scrollTop() + $(window).height() == $(document)[0].documentElement.scrollHeight){
            getPosts();
        }
    })
})

$("#post-btn").on("click", (e) => {
	let post_data = $("#post-form").serialize()
	$.ajax({
		url: "cleck/post",
		data: post_data,
		method: "post",
		success: function(response){
            $("#post-text").val("");
			window.location.reload()
		}
	})
	e.preventDefault()
})