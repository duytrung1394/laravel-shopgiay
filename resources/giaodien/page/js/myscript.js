$(document).ready(function (){
	$(".cart-select").click(function(e){
    $('.popup__cart-body').slideToggle();
     $('.popup__login-body').slideUp();
  	if($(".cart__list-item").height() < 200)
	{
		$(".cart__list-item").css('overflow-y',"hidden");
	}else{
		$(".cart__list-item").css('overflow-y',"scroll");
	}
    e.stopPropagation();

	});

	$(".popup__cart-body").click(function(e){
	    e.stopPropagation();
	});
	$(document).click(function(){
	    $(".popup__cart-body").slideUp();
	    $('.popup__login-body').slideUp();
	});
	$('.login-select').click(function(e){
		$('.popup__login-body').slideToggle();
		$(".popup__cart-body").slideUp();
		 e.stopPropagation();
	});
	$(".popup__login-body").click(function(e){
	    e.stopPropagation();
	});
	
	//show cart detail
	$('.show-siderbar__main').click(function (){
		$('.sidebar__main').slideToggle();
	});
});