//
function fancybox_initialisation() {

	var parametres = {
		helpers :  {
			title : {
				type : 'inside'
			},
			overlay : {
				showEarly : false
			}
		}
	};
	
	$(".lightbox").fancybox(parametres);

}