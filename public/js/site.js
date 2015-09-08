$( document ).ready(function() {  

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});


$(".selectAuto").select2({
  placeholder: "Where Do You Live?",
});

$(".smallPhoto").on("click",function(){
	var image = $(this).find('img').attr('src');
	$(".mainImage").attr('src',image);
});

$(".js-example-basic-multiple").select2();


 $(".money").maskMoney({thousands:'', decimal:'.', allowZero:true});

 $("body").on("click","#closeListing",function(){
 	$.ajax({
	  url: '/listing/delete',
	  type: "post",
	  data: {'listing':$(this).data('id'), '_token': $('input[name=_token]').val()},
	  success: function(data){
	    location.reload();
	  }
	}); 
 })

  

});