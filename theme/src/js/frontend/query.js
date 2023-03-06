const do_cat_click = (li) => {
    let ul = li.tagName == 'LI' ? li.parentElement : false;
    //error with markup
    if(!ul) return false;
    
    if(li.hasAttribute('data-slug') && li.dataset.slug == '*'){
        //clicking All on active All does nothing
        if(li.classList.contains('active')) return false;
        for(let listitem of ul.children) {
            if(listitem === li){
                listitem.classList.toggle('active');
            } else {
                listitem.classList.remove('active');
            }
        }
        return true;
    } else {
        li.classList.toggle('active');
        let all = ul.querySelector('[data-slug="*"]');
        if(all) all.classList.remove('active');
        return true;
    }
}
export const do_post_cat_pagination = (event) => {
    //update the parent data attributes
    let paged = (event.target.hasAttribute('data-paged')) ? event.target.dataset.paged : false;
    let parent = event.target.closest('.querywrap');
    if(parent && paged) parent.setAttribute('data-paged', paged);
    //pass the click - easy peasy
    doOnloadQuery(parent, true);
}
export const do_generic_post_category = (event) => {
    let parent = event.target.closest('.querywrap');
    //first toggle active 
    let this_li = event.target.classList.contains('post-category') ? event.target : event.target.closest('.post-category');
    let good_click = do_cat_click(this_li);
    let selected = [];
    if(good_click){
        let categorylist = event.target.closest('.query-controls');
        Array.from(categorylist.children).forEach( function(li){

            if(li.classList.contains('active')){ selected.push(li.dataset.slug) }

        });      
    }
    console.log(selected);
    

    /* collect category slugs */

    let query = parent.hasAttribute('data-query') ? parent.dataset.query : false;
    let posttype = parent.hasAttribute('data-posttype') ? parent.dataset.posttype : 'post';
    let args = parent.hasAttribute('data-args') ? parent.dataset.args : false;
    if(parent.hasAttribute('data-categories-selected')) parent.dataset.categoriesSelected = selected;
    let nonce = window.theme_vars.nonce;
    let url = window.theme_vars.ajaxurl;



    if(nonce && url && query){
        
        url+='?action=' + query + '&nonce=' + nonce;
        let senddata = '&nonce=' + nonce;
        senddata+='&post_type=' + encodeURIComponent(posttype);
        if(selected){
            //categories will be in comma separated slugs which means arrays and single both work the same
            senddata+='&categories_selected='+encodeURIComponent(selected);
        }
        /* pagination */
        let perpage = parent.hasAttribute('data-posts-per-page') ? parent.dataset.postsPerPage : false;
        if(perpage) senddata+='&posts_per_page=' + encodeURIComponent(perpage);
        if(args) {
            //are the args in JSON
            let jsonargs = toJSON(args);
            if(jsonargs){
                senddata+='&args='+encodeURIComponent(args);
            } else {
                //otherwise try to make sense of the array
                senddata+='&args='+ new URLSearchParams(args);
            } 
        }
        let showcontrols = parent.hasAttribute('data-show-controls') ? parent.dataset.showControls :  false;
        if(showcontrols && showcontrols.length ) senddata+='&showcontrols='+encodeURIComponent(showcontrols);
        let showpagination = parent.hasAttribute('data-show-pagination') ? parent.dataset.showPagination : false;
        if(showpagination && showpagination.length) senddata+='&showpagination='+encodeURIComponent(showpagination);
        let postin = parent.hasAttribute('data-post-in') ? parent.dataset.postIn : false;
        if(postin && postin.length) senddata+='&postin='+encodeURIComponent(postin);
        console.log(senddata);
        sendit(url, senddata).then( (r)=>{ 
            let html;
            if(r.status === 200){ 
                html = r.payload;
            } else {
                html = r.message ? r.message : "Something went wrong with this request.";
            }
            parent.innerHTML = html;
            
        });
    }
}
export const doOnloadQuery = (elem, scrollto = false) => {
    let query = elem.hasAttribute('data-query') ? elem.dataset.query : false;
    let posttype = elem.hasAttribute('data-posttype') ? elem.dataset.posttype : 'post';
    let args = elem.hasAttribute('data-args') ? elem.dataset.args : false;
    let categories = elem.hasAttribute('data-categories-selected') ? elem.dataset.categoriesSelected : false;
    let nonce = window.theme_vars.nonce;
    let url = window.theme_vars.ajaxurl;

    if(nonce && url && query){
        
        url+='?action=' + query + '&nonce=' + nonce;
        let senddata = '&nonce=' + nonce;
        senddata+='&post_type=' + encodeURIComponent(posttype);
        if(categories){
            //categories will be in comma separated slugs which means arrays and single both work the same
            senddata+='&categories_selected='+ new URLSearchParams(categories);
        }
        /* pagination */
        let perpage = elem.hasAttribute('data-posts-per-page') ? elem.dataset.postsPerPage : false;
        let paged = elem.hasAttribute('data-paged') ? elem.dataset.paged : false;
        if(args) {
            //are the args in JSON
            let jsonargs = toJSON(args);
            if(jsonargs){
                senddata+='&args='+encodeURIComponent(args);
            } else {
                //otherwise try to make sense of the array
                senddata+='&args='+ new URLSearchParams(args);
            }
            
        }
        if(perpage) senddata+='&posts_per_page=' + encodeURIComponent(perpage);
        if(paged) senddata+='&paged=' + encodeURIComponent(paged);
        let showcontrols = elem.hasAttribute('data-show-controls') ? elem.dataset.showControls :  false;
        if(showcontrols && showcontrols.length ) senddata+='&showcontrols='+encodeURIComponent(showcontrols);
        let showpagination = elem.hasAttribute('data-show-pagination') ? elem.dataset.showPagination : false;
        if(showpagination && showpagination.length) senddata+='&showpagination='+encodeURIComponent(showpagination);
        let postin = elem.hasAttribute('data-post-in') ? elem.dataset.postIn : false;
        if(postin && postin.length) senddata+='&postin='+encodeURIComponent(postin);
        console.log(senddata);
        
        sendit(url, senddata).then( (r)=>{
            var wrap = elem.closest('.querywrap');
            let html;
            if(r.status === 200){ 
                html = r.payload;
            } else {
                html = r.message ? r.message : "Something went wrong with this request.";
            }
            wrap.innerHTML = html;
            if(scrollto){
                var box = elem.getBoundingClientRect();
                var body = document.body;
                var docEl = document.documentElement;
                var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
                var clientTop = docEl.clientTop || body.clientTop || 0;
                var top  = box.top +  scrollTop - clientTop;
                window.scrollTo({
                    top: top,
                    left: 0,
                    behavior: 'smooth'
                });
            }

            
        });
    }

}

function toJSON(str){ 
    try {
        var obj = JSON.parse(str);
        if (obj && typeof obj === "object") {
            return obj;
        }
    } 
    catch (e) {
        console.log(e)
        return false;
    }
}