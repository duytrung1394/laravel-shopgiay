$(document).ready(function (){
   	$('.btn-xoa').click(function(){
       var c = confirm('Bạn Muốn xóa dòng Dữ liệu này?');
       if(c==false){
        return false;
       }
    });
});
