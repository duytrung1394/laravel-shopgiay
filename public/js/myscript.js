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

	$(".nav__sidebar a").click(function(){
				//slide tất cả các ul con
				$(".nav__sidebar ul ul").addClass('active-ul');
				$(".nav__sidebar ul ul").slideUp();
				//Hiện gly down ở các ul khác
				$(".nav__sidebar ul li a span").removeClass('glyphicon-chevron-up');
				$(".nav__sidebar ul li a span").addClass('glyphicon-chevron-down');
				//Hiện gly up ở thẻ này
				$(this).children().addClass('glyphicon-chevron-down');
				$(this).children().removeClass('glyphicon-chevron-up');
				// nếu ul con không được hiện thỉ thì thả ul xuống khi click
				if(!$(this).next().is(":visible"))
				{
					$(this).next().slideDown();
					
					// ul hiện thì thêm sly up
					$(this).children().addClass('glyphicon-chevron-up');
					$(this).children().removeClass('glyphicon-chevron-down');
				}
			});
	// nếu li được active thì hiện thị ul cha của li
	$('.active-li').closest('ul').show();
	// hiện gly up
	$('.active-li').closest('ul').prev().children().addClass('glyphicon-chevron-up');
	$('.active-li').closest('ul').prev().css('color','#339999');
	$('.active-li').closest('ul').prev().children().css('color','#333');
	$('.active-li').closest('ul').prev().children().removeClass('glyphicon-chevron-down');

});