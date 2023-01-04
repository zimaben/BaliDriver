Welcome to the KT Boilerplate Wordpress Theme

Create a new theme:
You've already created new local folder for the plugin you want to create and downloaded the boilerplate repo.
So let's pick up from there

## 👉  `bash installer.sh`
- This will ask you the name of your plugin plus the namespace or prefix
- With that information it will build the boilerplate for the Plugin and install the front-end tooling

Front-end Tooling

## 👉  `npm run dev`
- Used to have Webpack watch your src folder and output the results to dist folder.
- No need to run fancy builds, you should be bundled on-the-go

Back-end Tooling
- The backend structure looks like this:
- - library
- - - admin
- - - api
- - - blocks
- - - core
- - - schema
- - - template
- - src
- - dist
- - vendor

The back-end files within each library folder should be commented to show example use. More documentation on this to come

## Builtin Javascript
 - At the bottom of the document, a DOM query is made for the [data-process] data attribute. These data attributes are included in the base theme (depending on wp-theme-config.php) for things like Progressive Headers. If an element has a data-process="DoProgressiveHeader" the JS will be fired on that element.
 ## Progressive Header
 - Data-process support is built in for progressive headers. add data-process="DoProgressiveHeader" on any element you want to fire progressive headers on. The markup needs to fit (@todo - finish with example) and the .aspect-ratio-fill element needs to be correctly set in CSS to the height/width (aspect-ratio css) in order for the progressive header to work correctly.
 ## Scroll Triggers/Effects
 - Data-process support is also built in for scroll events. The /frontend/scroll.js file has default javascript for adding an active class or callback to any element with appropriate data attributes. Use the "atScroll" data-process tag on any element that you want to animate or otherwise mess with when it enters the viewport.
 
 - Example use:
 
    `<section class="myclass" data-process="atScroll">An "active" class will be inserted to this element when it scrolls into the viewport</section>`
 
	`<section class="myclass" data-process="atScroll" data-scroll-offset="-200px">An "active" class will be inserted to this element 200 pixels after it scrolls into the viewport</section>`
	
	

	`<section class="myclass" data-process="atScroll" data-scroll-offset="-200px" data-callback="parallaxScroll">The callback function parallaxScroll will be called 200px after this element scrolls into the viewport. If a corresponding parallaxScroll function with export does not exist in frontend.scroll.js it will throw an error.</section>`

