/* STILL NEED TO FINISH THESE */
export const doDismiss = (event) => {
    let dismissable = document.querySelectorAll(".active.dismissable");
    let protectedlist = event.target.querySelectorAll(".active.dismissable");
    for(let item of dismissable){
      let dismiss = true;
      for(let plitem of protectedlist){
        if(plitem === item) dismiss = false;
      }
      if(dismiss) item.classList.remove("active", "dismissable");
    }
  }
  export const mobileExpand = (event) => {
    let button = event.target;
    let header = button.closest("HEADER");
    let body = document.querySelector("BODY");
    let mobilemenu = button.dataset.menuTarget ? document.getElementById(button.dataset.menuTarget) : false;
    if(mobilemenu){
      //lock body scroll. see layout css
      body.classList.toggle("mobile-menu-expanded");
      if(!mobilemenu.classList.contains("active")){
        //first time popping menu;
        mobilemenu.classList.add("active");
        mobilemenu.classList.add("slidein");
        mobilemenu.classList.remove("slideout");
      } else {
        //timeout to remove active class;
        mobilemenu.classList.add("slideout");
        mobilemenu.classList.remove("slidein");
        setTimeout( ()=> {
          let mm = document.querySelector('.slideout');
          mm.classList.remove("active");
        }, 400);
      }
    } 
  }
 const mobileMenuClick = event => {
  
    let button = event.target;
    let header = button.closest("HEADER");
    let body = document.querySelector("BODY");
    let mobilemenu = header.querySelector('.mobile-menu');
    if(mobilemenu){
      body.classList.toggle("mobile-menu-expanded");
      mobilemenu.classList.toggle("active");
      if(mobilemenu.classList.contains("active")){
        mobilemenu.classList.remove("slideout");
        mobilemenu.classList.add("slidein");
      } else {
        mobilemenu.classList.remove("slidein");
        mobilemenu.classList.add("slideout");
      }
    } 
  }
  
  export const menuClick = (event) => {
    let li = event.target.tagName === "LI" ? event.target : event.target.closest("LI");
    let menuitems = document.getElementsByClassName('menu-item');
    for(let item of menuitems){
      if(item === li){
        if(li.classList.contains("active")){
          li.classList.remove("active");
          li.classList.remove("dismissable");
        } else {
          li.classList.add("active");
          li.classList.add("dismissable");
          event.stopPropagation();
        }
      } else {
        item.classList.remove("active");
        item.classList.remove("dismissable");
  
      }
    }
  }
  
  export const doMenuClicks = () => {
    let menuitems = document.getElementsByClassName('menu-item');
    for(let menuitem of menuitems) menuitem.addEventListener('click', menuClick);
  
  }
  export const doMobileMenuClick = () => {
    let burger = document.querySelectorAll('.hamburger-menu.mobile-only');
    if(burger){
      for(let bg of burger) bg.addEventListener('click', mobileMenuClick );
    }
  }
  
  export const accordionClick = (event) => {
    //just in case the plus icon is clicked on this event should cover both with bubbling
    let title = event.target.tagName === "H4" ? event.target : event.target.closest("H4");
    let parent = title.closest(".rbt-accordion");
    let panel = parent ? parent.querySelector(".rbt-accordion-panel") : false;
    if(title && panel){
  
      title.classList.toggle("expanded");
      if(panel.style.maxHeight){
        panel.style.maxHeight = null;
        panel.classList.toggle("expanded");
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        panel.classList.toggle("expanded");
      }
    }
  }
  
  export const doAccordionClicks = () => {
    let accordions = document.getElementsByClassName("rbt-accordion");
    if(accordions.length){
      for(let accordion of accordions){
        let title = accordion.querySelector(".accordion");
        title.addEventListener('click', accordionClick );
      }
    }
  }

  export const stickyNav = () => {
    // Get the navbar
    let navbar = document.getElementById("site-header");
    // Get the offset position of the navbar
    let sticky = navbar.clientHeight + 20;

    if (window.pageYOffset >= sticky){
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }
  
  export const sendit = async(location, senddata ) => {
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