import { menuClick, doMenuClicks, mobileExpand, accordionClick, doAccordionClicks } from './frontend/global.js';

const pageHeaderVideo = () => {

  let phv = document.getElementById('pageheadervideo');
  if(phv){
    let hasSource = phv.getElementsByTagName('SOURCE');
    //if(hasSource.length === 0){
      const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
      let source = (vw < 768) ? phv.dataset.mobileSource : phv.dataset.desktopSource;
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

    //} else {console.log(hasSource)}
  }

}
const doProgressiveHeader = (canvas) =>{
    if(!canvas.tagName || canvas.tagName !== "CANVAS") {
        canvas = canvas.querySelector('canvas');
        if(!canvas) return;
    }
    let header = canvas.closest('.hero-holder');
    if(canvas.id === "pageheader-0"){
      header.classList.add('notfound');
      return;
    }
    //get viewport width;
    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    //get proper aspect ratio
    /* The theory here is we have a "fill box" that always has the proper aspect ratio for each
    post type header. This fill box will match at desktop resolutions, but at mobile resolutions
    where the image gets a new aspect ratio thanks to minimum height it will be smaller.  
    Instead of wasting server resources and bandwidth cropping and storing a new image, we re-crop the image by looking
    by drawing the picture as big as it should be at current height and crop left appropriately
    so the image is not stretched. */
    let aspectbox = document.querySelector('.aspectRatioPlaceholder');
    aspectbox = aspectbox ? aspectbox.querySelector('.aspect-ratio-fill') : false;
    let aspectMultiplier = aspectbox ?  aspectbox.clientWidth / aspectbox.clientHeight : false;
    
    canvas.height = header.clientHeight;
    canvas.width = header.clientWidth;

    if(aspectMultiplier){
      if(Math.round(canvas.width) < (Math.round( canvas.height * aspectMultiplier)) ){
        //the aspect ratio of the canvas does not match the aspect ratio of the image
        //cropping is necessary

        leftcrop_px = ((canvas.height * aspectMultiplier) - canvas.width) / 2;
        leftcrop_pct = Math.round( leftcrop_px / (canvas.height * aspectMultiplier) * 100 ) / 100;

      } else{

        aspectMultiplier = false;
        leftcrop_pct = 0;
      }
    } 
    let expectedWidth = aspectMultiplier ? canvas.height * aspectMultiplier : false;

    let gridwidth = 1512; //width of the design grid - change this per project
    let startingresolution = Math.round(gridwidth / 4); 
    let ctx = canvas.getContext('2d');
    ctx.clearRect(0,0, canvas.width, canvas.height);
    var background = new Image();
    let blurlevel = 25;
    //serve blurred thumbnail first then load full image 
    background.src = canvas.getAttribute('data-img-src-1');
    background.onload = function(){
      ctx.filter = 'blur('+blurlevel+'px)';
      let sizeMultiplier = expectedWidth ? background.naturalWidth / expectedWidth : false;
      let drawheight = sizeMultiplier ? canvas.height * sizeMultiplier : Math.min(canvas.height,background.naturalHeight);
      if(sizeMultiplier){
        ctx.drawImage(background, background.naturalWidth * leftcrop_pct, 0, canvas.width * sizeMultiplier, drawheight, 0,0, canvas.width, canvas.height);
      } else {
        ctx.drawImage(background, 0,0,canvas.width, canvas.height);
      }
      
      ctx.filter = 'none';
        //now we have something on the page lets get it into focus
        updateImage(canvas, ctx, startingresolution, 2, 25, aspectMultiplier, leftcrop_pct, expectedWidth);
    }
    //fire off video
    pageHeaderVideo();
  }
  
const updateImage = (canvas, ctx, currentresolution = null, counter = null, blurlevel, aspectMultiplier = null, leftcrop_pct, expectedWidth) => {

    return new Promise((resolve, reject) => {

      if(!currentresolution) reject('Must have a resolution');
      if(!ctx) ctx = canvas.getContext('2d');
      if(!counter) counter = 1;
      const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
      if(currentresolution < vw){

        let nextresolution = parseInt(canvas.getAttribute('data-img-size-'+counter));
        let nextimage = canvas.getAttribute('data-img-src-'+counter);
        let checklast = 'data-img-size-'+(counter+1);
        if(nextresolution && nextimage){
          let moreimg = canvas.hasAttribute(checklast);

          blurlevel = moreimg ? Math.round(blurlevel * .5 ) : 0;
          background = new Image();
          background.src = nextimage;
          background.onload = function(){
            ctx.filter = blurlevel ? 'blur('+blurlevel+'px)' : 'none';
            if(aspectMultiplier){
              
              let sizeMultiplier = expectedWidth ? background.naturalWidth / expectedWidth : false;
              let drawheight = sizeMultiplier ? canvas.height * sizeMultiplier : Math.min(canvas.height,background.naturalHeight);
              if(sizeMultiplier){
                
                ctx.drawImage(background, background.naturalWidth * leftcrop_pct, 0, canvas.width * sizeMultiplier, drawheight, 0,0, canvas.width, canvas.height);
              
              } else {
                ctx.drawImage(background,0,0, canvas.width, canvas.height);
              }
            } else {
              ctx.drawImage(background,0,0, canvas.width, canvas.height);
            }
            
            ctx.filter = 'none';
            if(moreimg) {
              //  recursive call
              // setTimeout(() => {
              //     updateImage(canvas, ctx, nextresolution, counter+1, blurlevel);
              //     resolve();} , 1500);
              updateImage(canvas, ctx, nextresolution, counter+1, blurlevel, aspectMultiplier, leftcrop_pct, expectedWidth);
              resolve();
            } else { 
                //the end of the line
                resolve();
            }
          }
        } else {
        reject('something went wrong');
        }

      } else { 
        //final run - take off blur
        console.log("expectedWidth", expectedWidth)
        currentimg = canvas.getAttribute( 'data-img-src-'+ counter );
        background = new Image();
        background.src = currentimg;
        background.onload = function(){
          ctx.filter = 'none;'
          if(aspectMultiplier){
            console.log('lastrun');
            console.log("expectedWidth", expectedWidth)
            let sizeMultiplier = expectedWidth ? background.naturalWidth / expectedWidth : false;
            console.log("sizeMultiplier", sizeMultiplier);
            let drawheight = sizeMultiplier ? canvas.height * sizeMultiplier : Math.min(canvas.height,background.naturalHeight);
            console.log("drawheight", drawheight);
            console.log("startleft", background.naturalWidth * leftcrop_pct)
            if(sizeMultiplier){
              
              ctx.drawImage(background, background.naturalWidth * leftcrop_pct, 0, canvas.width * sizeMultiplier, drawheight, 0,0, canvas.width, canvas.height);
            
            } else {
              ctx.drawImage(background,0,0, canvas.width, canvas.height);
            }
          } else {
            ctx.drawImage(background,0,0, canvas.width, canvas.height);
          }
            resolve(); 
          }
        }
    });
}


const onload_data_fetch = () => {
  let fetchable = document.querySelectorAll('[data-fetch-posttype]');
  if(! fetchable) {console.log("nothing fetchable");return false;}

  let url = window.theme_vars.ajaxurl;
  let nonce = window.theme_vars.nonce;

  if(!url || !nonce ) return false;
  
  Array.from(fetchable).map( (dofetch) => { 

    let posttype = dofetch.dataset.fetchPosttype;
    let target = dofetch.dataset.fetchTarget;
    let filters = get_filters(dofetch);
    let senddata = '&nonce=' + nonce;
    if( dofetch.hasAttribute('data-fetch-action') && dofetch.dataset.fetchAction ){
      url+='?action=' + dofetch.dataset.fetchAction + '&nonce=' + nonce;
      senddata+= filters ? '&' + filters : '';
      let response_target = document.getElementById(target) ? document.getElementById(target) : dofetch.querySelector('.data-target');
      if(!response_target) {console.log("no data target"); return false;}
      console.log(url, senddata);
      sendit(url, senddata).then( (r)=>{
          console.log("doing postit");
          if(r.status === 200){
              console.log(r);
              response_target.innerHTML = r.payload;
          } else {
              console.log(r);
          }
      });
    } else {console.log('no data fetch action')};
  });
}
/* Standard Wordpress POST request via native fetch using form-urlencoded data */
const postit = async(location, senddata ) => {
  const settings = {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body:senddata
  };
  try {
      const fetchResponse = await fetch(location, settings);
      const receivedata = await fetchResponse.json();
      return receivedata;
  } catch (e) {
      console.log(e);
      return e;
  } 
}

const setupModals = () => {
  //tingle is the modal library I'm trying out
  //https://tingle.robinparisi.com/
  let links = document.querySelectorAll('[data-modal-link]');
  if(links){
    for(let link of links){
      link.addEventListener('click', (e) =>{
        let target = e.target.dataset.modalLink;
        let targetelement = target ? document.getElementById(target) : false;
        if(targetelement){
            let clone = targetelement.cloneNode()

            var md = new tingle.modal({
              closeMethods: ['overlay', 'button', 'escape'],
              closeLabel: "X",
              cssClass: ['nopad'],
              onOpen: function() {
                  console.log('modal open');
              },
              onClose: function() {
                  clone.remove();
              },
              beforeClose: function() {
                  // here's goes some logic
                  // e.g. save content before closing the modal
                  return true; // close the modal
                  return false; // nothing happens
              }
            });
            
            clone.setAttribute("controls", "controls");
            md.setContent( clone  );
            md.open();
            clone.play();
        }
      });
    }
  }
}

/* sorry webpack */
window.setupModals = setupModals;
window.postit = postit;
window.onload_data_fetch = onload_data_fetch;
window.doProgressiveHeader = doProgressiveHeader;
window.updateImage = updateImage;
window.accordionClick = accordionClick;
window.doAccordionClicks = doAccordionClicks;
window.menuClick = menuClick;
window.doMenuClicks = doMenuClicks;
window.mobileExpand = mobileExpand;
//window.doMobileMenuClick = doMobileMenuClick;