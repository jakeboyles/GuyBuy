$( document ).ready(function() {  


$(".selectAuto").select2({
  placeholder: "Where Do You Live?",
});

$(".smallPhoto").on("click",function(){
	var image = $(this).find('img').attr('src');
	$(".mainImage").attr('src',image);
});


 $(".money").maskMoney({thousands:'', decimal:'.', allowZero:true})


});