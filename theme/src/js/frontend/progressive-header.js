

/* Utility Functions */

/* setUpCanvas 
  sets height and width of canvas element placeholding the header image
  accepts:
    canvas - DOMElement: canvas element with predetermined data attributes
    vw - integer: viewport width of screen 
  returns:
    na
/*/

export const setUpCanvas = (canvas, vw) => {
  let aspect_w = canvas.dataset.aspectWidth;
  let aspect_h = canvas.dataset.aspectHeight;
  let minheight = canvas.hasAttribute('data-min-height') ? canvas.dataset.minHeight : 0;
  var canvas_height_multiplier;
  if( aspect_h !== "auto"){
    canvas_height_multiplier = (aspect_w && aspect_h) ?   aspect_h / aspect_w : false;
  } else {
    canvas_height_multiplier = "auto";
  }

  /* Give canvas dimensions */
  if(canvas_height_multiplier){
    if(canvas_height_multiplier === "auto"){
      //setting height to 0 will set this image height to auto during print
      canvas.height = 0;
    } else {
      canvas.height = Math.round( Math.max( Math.floor(vw * canvas_height_multiplier), minheight ));
    }
    
  } else {
    canvas.height = minheight;
  }
  canvas.width = vw;
}

/* pageHeaderVideo 
  loads video element if available from data attributes
  accepts:
    na
  returns:
    na
/*/
export const pageHeaderVideo = () => {

  let phv = document.getElementById('pageheadervideo');
  if(phv){
    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    let source = (vw < 768) ? phv.dataset.mobileSource : phv.dataset.desktopSource;
    if(source){
      let el = document.createElement('source');
      let extension = source.split('.');
      extension = Array.isArray(extension) ? extension[ extension.length - 1 ] : false;
      let type = 'video/mp4';
      if(extension !== 'mp4'){
        //only ogg and webm will benefit from not having an mp4 tag
        //.mov, .qt, and all other unsupported video types may use the same codec as mp4 
        // and not need conversion
        if(extension == 'ogg') type = 'video/ogg';
        if(extension == 'webm') type = 'video/webm';
      }
      el.setAttribute('type',type);
      el.setAttribute('src', source);
      phv.appendChild(el);
      phv.onloadeddata=function(){
        let holder = phv.closest('.hero-holder');
        if(holder){
          phv.width = holder.clientWidth;
          phv.height = holder.clientHeight;
        }
      }
      phv.setAttribute('src', source);
    }
  }

}
/* progressiveHeaderCheck 
  checks canvas element for required data attributes
  accepts:
    canvas - DOMElement
  returns:
    Boolean FALSE or canvas - DOMElement 
/*/
export const progressiveHeaderCheck = (canvas) =>{

  if(!canvas.tagName || canvas.tagName !== "CANVAS") {
      canvas = canvas.querySelector('canvas');
      if(!canvas){
        canvas = false;
      };
  }
  if(canvas.id === "pageheader-0"){
    let header = canvas.closest('.hero-holder');
    if(header) header.classList.add('notfound');
    console.log('No Featured Image')
    canvas = false;
  }
  if(canvas){

    if(!canvas.hasAttribute('data-aspect-width') || 
        !canvas.hasAttribute('data-aspect-height') || 
        !canvas.hasAttribute('data-img-sm-desktop') ) {
          console.log('Missing required data attributes')
    canvas = false;
    }
  }
  if(!canvas){
    let holder = document.querySelector('.aspectRatioPlaceholder');
    let spinner = holder ? holder.querySelector('.logo-spinner') : false;
    if(spinner) spinner.remove();
  }
  return canvas;

}
/* paintImage
  takes a loaded image and canvas with height/width and paints a cropped image to match the canvas
  dimensions in a similar fashion as CSS object-fit:cover 
  accepts:
    canvas - DOMElement
    img - loaded IMG Element (not attached to DOM)
    blurlevel - how much blur to use painting the image to canvas
  returns:
    img - loaded IMG Element
/*/
export const paintImage = (canvas, img, blurlevel ) => {

    const ctx = canvas.getContext("2d");
    var adjusted_natural_height;
    if(img.naturalWidth >= canvas.width){
      //need to get smaller
      let travel = img.naturalWidth - canvas.width;
      adjusted_natural_height = Math.round( img.naturalHeight - (travel * (img.naturalHeight / img.naturalWidth )) );
    } else {
      //need to get bigger
      let travel = canvas.width - img.naturalWidth;
      adjusted_natural_height = Math.round( img.naturalHeight + (travel * (img.naturalHeight / img.naturalWidth )) );
    }
    //if no canvas height set, treat canvas height as "auto" - ie appropriate natural height for width
    if(canvas.height == 0) canvas.height = adjusted_natural_height;
    //so now we have coords are canvas.width and adjusted_natural_height
    //we need to blow that up to uncropped cover size
    let y_diff = adjusted_natural_height - canvas.height;
    var expanded_width;
    var expanded_height;
    switch (y_diff !== Math.abs(y_diff)){
      case true : 
        //the width is the same and the height difference is negative
        //console.log("we are cropping X");
        expanded_width = canvas.width + (Math.abs(y_diff) * (img.naturalWidth / img.naturalHeight ));
        expanded_height = canvas.height;
        let size_x_multiplier = img.naturalWidth / expanded_width;
        let x_diff = expanded_width - canvas.width; 
        ctx.clearRect(0,0, canvas.width, canvas.height);
        ctx.filter = 'blur('+blurlevel+'px)';
        ctx.drawImage(img, (x_diff / 2), 0, (canvas.width * size_x_multiplier), img.naturalHeight, 0, 0, canvas.width, canvas.height); 
      break;
      case false : 
        //the width is the same and the height difference is equal or positive
        //console.log("we are cropping Y");
        expanded_width = canvas.width;
        expanded_height = adjusted_natural_height;
        let size_y_multiplier =img.naturalHeight / expanded_height;
        let draw_y_diff = expanded_height - canvas.height;
        ctx.clearRect(0,0, canvas.width, canvas.height);
        ctx.filter = 'blur('+blurlevel+'px)';
        // If you want to crop equally from top and bottom use this drawImage
       // ctx.drawImage(final, 0, (draw_y_diff / 2), final.naturalWidth, (canvas.height * size_y_multiplier), 0, 0, canvas.width, canvas.height); 
        //This crops from the top
        ctx.drawImage(img, 0, 0, img.naturalWidth, (canvas.height * size_y_multiplier), 0, 0, canvas.width, canvas.height); 
        break;
      default:
        break;
    }
  return img;
}
/* loadImages
  returns Promise of a queue of URLS that will paint the canvas  
  accepts:
    array - array of URL strings to synchronously paint on the canvas
    canvas - DOMElement to draw the images on
    blurlevel - initial blur to set on the drawImage. After each successfull 
  returns:
    Boolean FALSE or canvas - DOMElement 
/*/
export const loadImages = (array, canvas, blurlevel) => new Promise((resolve, reject) => {
    //recursively calls itself until array queue is down to 1 then resolves
    let lasturl = array[array.length -1 ];
    let url = array[0];
    var lastimage;
    loadImage(url).then( (img) => {
      lastimage = paintImage(canvas, img, blurlevel);
      blurlevel = parseInt(blurlevel / 2);
      if(img.src === lasturl){
        while(blurlevel >= 0){
          blurlevel--;
          paintImage(canvas, lastimage, blurlevel);
        }
        resolve(img);
      } else {
        array.shift();
        loadImages(array,canvas, blurlevel)
      }
    }).catch((err)=>{  reject(err) });

})
export const loadImage = ( url ) => new Promise((resolve, reject) => {
  if(!url) { reject("missing progressive header image");
  } else {
    const img = new Image();
    img.addEventListener('load', () => resolve(img));
    img.addEventListener('error', (err) => reject(err));
    img.src = url;
  }


});


export const doProgressiveHeader = async(canvas) => {
  canvas = progressiveHeaderCheck(canvas);
  if(!canvas) return false;
  //get viewport width;
  const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
  //sets canvas height & width and returns multiplier ( I don't think I need multiplier)
  setUpCanvas(canvas, vw);
  let queue = [];

  switch (true) {
    case (vw <= 767) : 
      //mobile tree
      let mobile_one = canvas.dataset.imgSmMobile;
      let mobile_two = canvas.dataset.imgLgMobile; 
      if(!mobile_one && !mobile_two){
        //no mobile images added, use small & medium desktop (will autocrop, probably badly)
        mobile_one = canvas.dataset.imgSmDesktop;
        mobile_two = canvas.dataset.imgMdDesktop;
        if(mobile_one) queue.push(mobile_one);
        if(mobile_two) queue.push(mobile_two);
      } else {
        //we have mobile images
        if(mobile_one) queue.push(mobile_one);
        if(mobile_two) queue.push(mobile_two);
      }

    break;
    
    case (vw > 767 && vw <= 1700) : 
      //desktop
      let desktop_one = canvas.dataset.imgSmDesktop;
      let desktop_two = canvas.dataset.imgMdDesktop;
      let desktop_three = canvas.dataset.imgLgDesktop;
      if(desktop_one) queue.push(desktop_one);
      if(desktop_two) queue.push(desktop_two);
      if(desktop_three) queue.push(desktop_three);

    break;
    
    case (vw > 1700) : 
      //wide
      let wide_two = canvas.dataset.imgMdDesktop;
      let wide_three = canvas.dataset.imgLgDesktop;
      let wide_four = canvas.dataset.imgFull;
      if(wide_two) queue.push(wide_two);
      if(wide_three) queue.push(wide_three);
      if(wide_four) queue.push(wide_four);
    break;
  }
  //queue, canvas, blurLevel to start at
  loadImages(queue, canvas, 25).then((img) =>{
    //handle Video  
    pageHeaderVideo();
  }).catch((err)=>{
    console.log(err);
    //try video 
    pageHeaderVideo();
  });

}