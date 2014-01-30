/**
 * Preloads images in a global array named <i>images</i>.
 * If there is a variable named <i>numPreloaded</i>, it will 
 * update the number of images preloaded in it.
 * @param arrayOfImages Array of images.  It has to contain a
 * attribute named <i>path</i>.
 */
function preload(arrayOfImages) {
    $(arrayOfImages).each(function(i){
    	images[i] = $('<img/>', {'src': this.path, 'id': 'img'+i});
    	images[i].addClass("cref_image");

    	images[i].load(function () {
    		slides[i].width = this.width;
    		slides[i].height = this.height;
    		
    		if (numPreloaded != undefined) 
    			numPreloaded++;
		});
    });
}