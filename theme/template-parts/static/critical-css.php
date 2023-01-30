<style type="text/css" id="inlinecss">@import url(https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap);
@import url(https://fonts.googleapis.com/css2?family=Merriweather+Sans&display=swap);
/* UTILITY */
/*<! START COLORS !>*/
/*<! END COLORS !>*/
/*<! START TYPOGRAPHY !>*/
H1 {
  font-family: Permanent Marker;
  font-weight: 400;
  text-transform: uppercase;
  font-size: clamp(36px, 3.33vw, 48px);
  letter-spacing: 0rem;
  line-height: clamp(52px, 4.86vw, 69.9375px);
}

H2 {
  font-family: Permanent Marker;
  font-weight: 400;
  font-size: clamp(27px, 2.5vw, 36px);
  letter-spacing: 0.12rem;
  line-height: clamp(39px, 3.64vw, 52.453125px);
}

H3 {
  font-family: Permanent Marker;
  font-weight: 400;
  font-size: clamp(23px, 2.15vw, 31px);
  letter-spacing: 0.15rem;
  line-height: clamp(34px, 3.14vw, 45.16796875px);
}

H4 {
  font-family: Permanent Marker;
  font-weight: 400;
  font-size: clamp(21px, 1.94vw, 28px);
  letter-spacing: 0.15rem;
  line-height: clamp(31px, 2.83vw, 40.796875px);
}

H5 {
  font-family: Permanent Marker;
  font-weight: 400;
  font-size: clamp(18px, 1.67vw, 24px);
  letter-spacing: 0.15rem;
  line-height: clamp(26px, 2.43vw, 34.96875px);
}

H6 {
  font-family: Permanent Marker;
  font-weight: 400;
  font-size: clamp(14px, 1.25vw, 18px);
  letter-spacing: 0.13rem;
  line-height: clamp(20px, 1.82vw, 26.2265625px);
}

body {
  font-family: Merriweather Sans;
  font-weight: 400;
  font-size: clamp(16px, 1.11vw, 24px);
  letter-spacing: 0rem;
  line-height: clamp(20.109375px, 1.4vw, 30.16px);
}

@media screen and (max-width: 991px) {
  H1 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  H2 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  H3 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  H4 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  H5 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  H6 {
    font-family: Permanent Marker;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0.12rem;
    line-height: 17.484375px;
  }
  body {
    font-family: Merriweather Sans;
    font-weight: 400;
    font-size: 12px;
    letter-spacing: 0rem;
    line-height: 15.0839996338px;
  }
}
/*<! END TYPOGRAPHY !>*/
/*<! START LAYOUT !>*/
/* Layout */
/* Space variable is a seed for how much padding in the layout */
/*<! END LAYOUT !>*/
/* Please put custom global variables beneath this comment. 
   Styles above this line may be overwritten */
/* CUSTOM */
/*
 * [Modified] Modern CSS Reset
 * @link https://github.com/hankchizljaw/modern-css-reset
*/
/* Box sizing rules */
*,
*::before,
*::after {
  box-sizing: border-box;
}

/* Remove default margin */
body,
h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 0;
}

html,
body {
  overflow-x: hidden;
}

html {
  scroll-behavior: smooth;
}

/* Set core body defaults */
body {
  min-height: 100vh;
  font-family: sans-serif;
  font-size: 100%;
  line-height: 1.5;
  text-rendering: optimizeSpeed;
}

/* Make images easier to work with */
img {
  display: block;
  max-width: 100%;
}

/* Inherit fonts for inputs and buttons */
input,
button,
textarea,
select {
  font: inherit;
}

/* Remove all animations and transitions for people that prefer not to see them */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
  html {
    scroll-behavior: initial;
  }
}
body {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  width: 100%;
  width: 100%;
  position: relative;
  overflow-y: scroll;
}
body.mobile-menu-expanded {
  overflow: hidden;
}

/* stick footer on the bottom */
#page {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 100%;
  overflow-x: hidden;
  flex-grow: 1;
}

ul li,
ol li {
  padding-bottom: 12.5px;
}

footer.site-footer {
  display: flex;
  background-color: #242e42;
  padding-left: clamp(25px, 10vw, 146px);
  padding-right: clamp(25px, 10vw, 146px);
  padding-top: 37.5px;
  padding-bottom: 50px;
  justify-content: space-between;
}

div.prefooter {
  padding-left: clamp(25px, 10vw, 146px);
  padding-right: clamp(25px, 10vw, 146px);
}

/* utility */
.centered {
  text-align: center !important;
  align-self: center;
  justify-self: center;
}

/* page layouts */
#content #main > .page-content > * {
  margin-left: clamp(25px, 10vw, 146px);
  margin-right: clamp(25px, 10vw, 146px);
}
#content #main > .page-content .alignwide {
  margin-left: 0;
  margin-right: 0;
}
#content #main > .page-content .alignfull {
  margin-left: 0;
  margin-right: 0;
}

/* index layouts */
.postwrap {
  padding-left: clamp(25px, 10vw, 146px);
  padding-right: clamp(25px, 10vw, 146px);
  padding-top: 12.5px;
  padding-bottom: 12.5px;
}
.postwrap:first-of-type {
  padding-top: 0;
}
.postwrap:last-of-type {
  padding-bottom: 50px;
}
.postwrap.alignwide {
  padding-left: 0;
  padding-right: 0;
}
.postwrap .layout {
  width: 100%;
  position: relative;
  display: flex;
  gap: clamp(18.75px, 2vw, 25px);
}
.postwrap .layout.reverse {
  flex-direction: row-reverse;
}
.postwrap .layout .left {
  display: flex;
  flex-direction: column;
  width: 35%;
}
.postwrap .layout .right {
  display: flex;
  flex-direction: column;
  width: 65%;
}

/* 404 */
.fourzerofour-graphic {
  display: block;
  width: 20%;
  max-height: 20%;
  margin-left: auto;
  margin-right: auto;
  padding: 3%;
  color: #242e42;
}

@media screen and (max-width: 991px) {
  .postwrap .layout {
    flex-wrap: wrap;
  }
  .postwrap .layout .left {
    width: 100%;
  }
  .postwrap .layout .right {
    width: 100%;
  }
}
a {
  color: #242e42;
}
a:active, a:hover {
  /* Darken on click by 15% (down to 85%) */
  filter: brightness(0.85);
}

.wp-block-button a,
.button a,
button a {
  text-decoration: none;
}

.wp-block-button.primary-color,
.button.primary-color,
button.primary-color,
.wp-block-button.accent-color,
.button.accent-color,
button.accent-color {
  color: #ffffff;
}

ul.menu-wrapper li {
  padding-top: 0;
  padding-bottom: 0;
}
ul.menu-wrapper li a {
  color: #ff6700;
  text-decoration: none;
  white-space: nowrap;
}

#site-header.sticky {
  /* sticky header */
  top: 0;
  position: fixed;
  z-index: 2;
}
#site-header.sticky + * {
  padding-top: 64px;
}
#site-header .mobile-menu-container .mobile-animation-wrap {
  width: 100%;
  height: 100%;
}
#site-header .mobile-menu-container .mobile-animation-wrap .mobile-menu {
  width: 100%;
  height: 100%;
}
#site-header .mobile-menu-container .mobile-animation-wrap .mobile-menu ul.menu-wrapper {
  height: 100%;
  padding: 0;
  list-style-type: none;
  gap: 37.5px;
  display: flex;
  flex-direction: column;
  font-size: 24px;
  margin-top: 32px;
  font-weight: 700;
  align-items: center;
  justify-content: center;
}
#site-header .mobile-menu-container .mobile-animation-wrap .mobile-menu ul.menu-wrapper li a {
  color: #242e42;
  text-decoration: none;
}

ul#footer-one-menu-list li,
ul#footer-two-menu-list li,
ul#footer-three-menu-list li,
ul#footer-four-menu-list li {
  padding-bottom: 6.25px;
}

h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  text-decoration: none;
}

a:has(> h1), a:has(> h2), a:has(> h3), a:has(> h4), a:has(> h5), a:has(> h6) {
  text-decoration: none !important;
}

#site-header {
  display: flex;
  width: 100%;
  height: 64px;
  position: relative;
  padding-left: clamp(25px, 10vw, 146px);
  padding-right: clamp(25px, 10vw, 146px);
  background-color: #242e42;
}
#site-header .mobile-menu-button {
  display: none;
  background-image: url(http://localhost:8005/wp-content/themes/<!PLUGINNAME->/theme/assets/icons/hamburger-button-white.svg);
  height: 100%;
  aspect-ratio: 1/1;
  background-repeat: no-repeat;
  background-position: center center;
  cursor: pointer;
}
#site-header .mobile-menu-close {
  background-image: url(http://localhost:8005/wp-content/themes/<!PLUGINNAME->/theme/assets/icons/close-white.svg);
  content: "";
  display: block;
  top: 18px;
  position: absolute;
  z-index: 2;
  height: 32px;
  width: 32px;
  background-repeat: no-repeat;
  background-position: center center;
  cursor: pointer;
}
#site-header .mobile-menu-container {
  display: none;
}
#site-header .mobile-menu-container.active {
  background-color: #7b8fb7;
  color: #ffffff;
  padding-left: 25px;
  padding-right: 25px;
  display: flex;
  flex-direction: column;
  position: fixed;
  min-height: 100vh;
  z-index: 2;
  top: 0;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 100vh;
}
#site-header .top.menu-logo {
  height: 100%;
}
#site-header .top.menu-logo .site-branding {
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  padding: 1%;
}
#site-header .top.menu-logo .site-branding a {
  color: #242e42;
  text-decoration: none;
  max-height: 100%;
}
#site-header .top.menu-logo .site-branding h1 {
  margin: 0;
}
#site-header .top.menu-logo .site-branding img {
  max-height: 100%;
}
#site-header .top.menu-container {
  display: flex;
  align-items: center;
}
#site-header .top.menu-container ul {
  list-style-type: none;
  margin: 0;
  display: inline-flex;
  gap: 12.5px;
}
@media screen and (max-width: 991px) {
  #site-header {
    height: 48px;
    padding-left: 13px !important;
    padding-right: 13px !important;
  }
  #site-header .mobile-menu-button {
    display: inline-flex;
    position: relative;
    z-index: 1;
  }
  #site-header .top.menu-logo .site-branding {
    position: absolute;
    display: flex;
    left: 0;
    z-index: 0;
    align-items: center;
    width: 100%;
  }
  #site-header .desktop-menu {
    display: none;
  }
}
/* Page Header with no Featured Image */
canvas#placeholder-0 {
  display: none;
}

.aspectRatioPlaceholder .overlay-text {
  padding-left: clamp(25px, 10vw, 146px);
  padding-right: clamp(25px, 10vw, 146px);
  padding-top: 25px;
}

/*# sourceMappingURL=critical.css.map*/</style>