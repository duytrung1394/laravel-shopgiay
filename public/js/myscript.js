$(document).ready(function (){
	$(".cart-select").click(function(e){
    $('.popup__cart-body').fadeToggle();
     $('.popup__login-body').fadeOut();
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
	    $(".popup__cart-body").fadeOut();
	    $('.popup__login-body').fadeOut();
	});
	$('.login-select').click(function(e){
		$('.popup__login-body').fadeToggle();
		$(".popup__cart-body").fadeOut();
		 e.stopPropagation();
	});
	$(".popup__login-body").click(function(e){
	    e.stopPropagation();
	});
	
	//show cart detail
	$('.show-siderbar__main').click(function (){
		$('.sidebar__main').slideToggle();
	});

	//nav
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
	// $('.active-li').closest('ul').show();
	// hiện gly up
	// $('.active-li').closest('ul').prev().children().addClass('glyphicon-chevron-up');
	$('.active-li').closest('ul').prev().css('color','#339999');
	$('.active-li').closest('ul').prev().children().css('color','#333');
	// $('.active-li').closest('ul').prev().children().removeClass('glyphicon-chevron-down');

	$('.product-submit-cart .disabled').closest('.a__submit').hover(function (){
		$(this).css('cursor','not-allowed');
	});
	//khi dong modal thì reload trang
	$('#myModal').on('hidden.bs.modal', function () {
  		document.location.reload();
	});

});
//initiate the plugin and pass the id of the div containing gallery images
	$("#img_01").elevateZoom({
		zoomType: "inner",
			cursor: "crosshair",
		constrainType:"height", 
		constrainSize: 274,
		gallery:'gallery_01', 
		// cursor: 'pointer',
		// zoomWindowWidth:400,
		// zoomWindowHeight:500,
		galleryActiveClass: "active"}); 

	//pass the images to Fancybox
	$("#img_01").bind("click", function(e) {  
	  var ez =   $('#img_01').data('elevateZoom');	
		$.fancybox(ez.getGalleryList());
	  return false;
	});

