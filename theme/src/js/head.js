import { menuClick, doMenuClicks, mobileExpand, accordionClick, doAccordionClicks } from './frontend/global.js';
import { do_generic_post_category, do_post_cat_pagination } from './frontend/query.js';
import * as header from './frontend/progressive-header.js';


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
window.accordionClick = accordionClick;
window.doAccordionClicks = doAccordionClicks;
window.menuClick = menuClick;
window.doMenuClicks = doMenuClicks;
window.mobileExpand = mobileExpand;
window.setUpCanvas = header.setUpCanvas;
window.pageHeaderVideo = header.pageHeaderVideo;
window.progressiveHeaderCheck = header.progressiveHeaderCheck;
window.paintImage = header.paintImage;
window.loadImages = header.loadImages;
window.doProgressiveHeader = header.doProgressiveHeader;
window.do_generic_post_category = do_generic_post_category;
window.do_post_cat_pagination = do_post_cat_pagination;
//window.doMobileMenuClick = doMobileMenuClick;