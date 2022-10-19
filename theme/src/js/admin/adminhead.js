/* Theme Options - Utility Tab Button clicks */
export const test_figma = async(e) =>{
    e.preventDefault();
    /* This button should only live within the WP Admin Theme Options
     - ajaxurl is already defined in the WP Admin, but I'm putting 
     everything I need in one localized admin object */
    let button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
    let url = theme_admin.ajaxurl + '/?action=test_figma';
    let nonce = theme_admin.nonce;
    let buttonwrap = button.closest('.buttonwrap');
    let responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
    if(!responsearea){ console.log("No form response area found"); return false; }
    if(url && nonce){
        let response = await postit(url, 'nonce=' + nonce);
        if(response.status === 200){

            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message; 
            
        } else {
            if( response.message ){
                responsearea.classList.remove('success', 'warning');
                responsearea.classList.add('error');
                responsearea.innerHTML = response.message; 
            } else {
                responsearea.classList.remove('success', 'warning');
                responsearea.classList.add('error');
                responsearea.innerHTML = "There was a problem with your request"; 
            }
        }
    } else {
        console.log("Tried to run first setup but could not find URL or Nonce");
    }
}
export const gmap_sync = async(e) => {
    e.preventDefault();
    /* This button should only live within the WP Admin Theme Options
     - ajaxurl is already defined in the WP Admin, but I'm putting 
     everything I need in one localized admin object */
     let button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
     let url = theme_admin.ajaxurl + '/?action=sync_map_data';
     let nonce = theme_admin.nonce;
     let buttonwrap = button.closest('.buttonwrap');
     let responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
     if(!responsearea){ console.log("No form response area found"); return false; }
     if(url && nonce){
         let response = await postit(url, 'nonce=' + nonce);
         if(response.status === 200){
 
             responsearea.classList.remove('error', 'warning');
             responsearea.classList.add('success');
             responsearea.innerHTML = response.message; 
             
         } else {
             if( response.message ){
                 responsearea.classList.remove('success', 'warning');
                 responsearea.classList.add('error');
                 responsearea.innerHTML = response.message; 
             } else {
                 responsearea.classList.remove('success', 'warning');
                 responsearea.classList.add('error');
                 responsearea.innerHTML = "There was a problem with your request"; 
             }
         }
     } else {
         console.log("Tried to run sync data but could not find URL or Nonce");
     }
}
export const run_first_setup = async(e) => {
    e.preventDefault();
    /* This button should only live within the WP Admin Theme Options
     - ajaxurl is already defined in the WP Admin, but I'm putting 
     everything I need in one localized admin object */
    let button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
    let url = theme_admin.ajaxurl + '/?action=run_setup';
    let nonce = theme_admin.nonce;
    let buttonwrap = button.closest('.buttonwrap');
    let responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
    if(!responsearea){ console.log("No form response area found"); return false; }
    if(url && nonce){
        let response = await postit(url, 'nonce=' + nonce);
        if(response.status === 200){

            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message; 
            
        } else {
            if( response.message ){
                responsearea.classList.remove('success', 'warning');
                responsearea.classList.add('error');
                responsearea.innerHTML = response.message; 
            } else {
                responsearea.classList.remove('success', 'warning');
                responsearea.classList.add('error');
                responsearea.innerHTML = "There was a problem with your request"; 
            }
        }
    } else {
        console.log("Tried to run first setup but could not find URL or Nonce");
    }
}
export const run_critical_css = (e) => {
    console.log("clicked run critical css");
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