$(function(){

$('#upImgBox').on('change', '[id^="tupian"]', function() {
	var img = $(this).get(0).files[0];
	var that = $(this);
	var reader = new FileReader();
	reader.readAsDataURL(img);
	reader.onloadend = function() {
		that.parent().next().find('img').attr("src", reader.result);
		that.parent().next().css('display', 'table-cell');
		that.parent().hide();
		that.parent().prev().show();
	}
})

$('.imgCloseIcon').click(function() {
	$(this).next().find("[id^='tupian']").get(0).files[0] = null;
	$(this).next().show();
	$(this).next().next().hide();
	$(this).hide();
})


})//  举报图片上传
