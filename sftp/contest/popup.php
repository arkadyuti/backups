<style>
@import "compass/css3";
html,body {margin:0; padding:10px; -webkit-backface-visibility:hidden;}
/* text-based popup styling */
.white-popup {
  position: relative;
  background: #FFF;
  padding: 25px;
  width:auto;
  max-width: 400px;
  margin: 0 auto; 
}
/* 
====== Zoom effect ======
*/
.mfp-zoom-in {
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    transition: all 0.2s ease-in-out; 
    transform: scale(0.8); 
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.3s ease-out;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: scale(1); 
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: scale(0.8); 
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== Newspaper effect ======
*/
.mfp-newspaper {
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    -webkit-transition: all 0.2s ease-in-out; 
    transition: all 0.5s;
    transform: scale(0) rotate(500deg);
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.5s;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: scale(1) rotate(0deg);
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: scale(0) rotate(500deg);
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== Move-horizontal effect ======
*/
.mfp-move-horizontal {
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    transition: all 0.3s;
    transform: translateX(-50px);
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.3s;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: translateX(0);
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: translateX(50px);
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== Move-from-top effect ======
*/
.mfp-move-from-top {
  .mfp-content {
   vertical-align:top; 
  }
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    transition: all 0.2s;
    transform: translateY(-100px);
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.2s;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: translateY(0);
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: translateY(-50px);
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== 3d unfold ======
*/
.mfp-3d-unfold {
  .mfp-content {
    perspective: 2000px; 
  }
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    transition: all 0.3s ease-in-out;
    transform-style: preserve-3d;
    transform: rotateY(-60deg);
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.5s;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: rotateY(0deg);
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: rotateY(60deg);
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== Zoom-out effect ======
*/
.mfp-zoom-out {
  /* start state */
  .mfp-with-anim {
    opacity: 0;
    transition: all 0.3s ease-in-out; 
    transform: scale(1.3); 
  }
  &.mfp-bg {
    opacity: 0;
	  transition: all 0.3s ease-out;
  }
  /* animate in */
  &.mfp-ready {
    .mfp-with-anim {
      opacity: 1;
      transform: scale(1); 
    }
    &.mfp-bg {
      opacity: 0.8;
    }
  }
  /* animate out */
  &.mfp-removing {
    .mfp-with-anim {
      transform: scale(1.3); 
      opacity: 0;
    }
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* 
====== "Hinge" close effect ======
*/
@keyframes hinge {
	0% { transform: rotate(0); transform-origin: top left; animation-timing-function: ease-in-out; }	
	20%, 60% { transform: rotate(80deg); transform-origin: top left; animation-timing-function: ease-in-out; }	
	40% { transform: rotate(60deg); transform-origin: top left; animation-timing-function: ease-in-out; }	
	80% { transform: rotate(60deg) translateY(0); opacity: 1; transform-origin: top left; animation-timing-function: ease-in-out; }	
	100% { transform: translateY(700px); opacity: 0; }
}
.hinge {
  animation-duration: 1s;
	animation-name: hinge;
}
.mfp-with-fade {
  // before-open state
  .mfp-content,
  &.mfp-bg {
    opacity: 0;
    transition: opacity .5s ease-out;
  }
  // open state
  &.mfp-ready {
    .mfp-content {
     opacity: 1; 
    }
    &.mfp-bg {
      opacity: 0.8; // background opacity
    }
  }
  // closed state
  &.mfp-removing {
    &.mfp-bg {
      opacity: 0;
    }
  }
}
/* preview styles */
html {
  font-family: "Calibri", "Trebuchet MS", "Helvetica", sans-serif;
}
h3 {
  margin-top: 0;
  font-size: 24px;
}
a,
  a:visited {
    color: #1760BF;
    text-decoration: none;
  }
  a:hover {
    color: #c00;
  }
.links {
  ul {
  }
  li {
   margin-bottom: 5px; 
  }
}
h4 {
  margin: 24px 0 0 0;
}
.bottom-text {
  margin-top: 40px;
  border-top: 2px solid #CCC;
  a {
    border-bottom: 1px solid #CCC;
  }
  p {
   max-width: 650px; 
  }
}
</style>
<html>
	<head>
		<script src="./jquery.min.js"></script>
        <script src="./respond.min.js"></script>
	</head>
	<body>
	<h3>Magnific Popup CSS3-based animation effects</h3>
	<div class="links">
	  <h4>Text-based:</h4>
	  <ul id="inline-popups">
		<li><a href="#test-popup" data-effect="mfp-zoom-in">Zoom</a></li>
		<li><a href="#test-popup" data-effect="mfp-newspaper">Newspaper</a></li>
		<li><a href="#test-popup" data-effect="mfp-move-horizontal">Horizontal move</a></li>
		<li><a href="#test-popup" data-effect="mfp-move-from-top">Move from top</a></li>
		<li><a href="#test-popup" data-effect="mfp-3d-unfold">3d unfold</a></li>
		<li><a href="#test-popup" data-effect="mfp-zoom-out">Zoom-out</a></li>
	  </ul>
	  <a href="#test-popup" class="hinge">Popup with "hinge" close effect</a> (based on animate.css)
	  <h4>Image-based:</h4>
	  <ul id="image-popups">
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-zoom-in">Zoom</a></li>
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-newspaper">Newspaper</a></li>
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-move-horizontal">Horizontal move</a></li>
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-move-from-top">Move from top</a></li>
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-3d-unfold">3d unfold</a></li>
		<li><a href="http://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg/800px-Prasat_Sikhoraphum_-_Sikhoraphum_edit1.jpg" data-effect="mfp-zoom-out">Zoom-out</a></li>
	  </ul>
	</div>
	<!-- Popup itself -->
	<div id="test-popup" class="white-popup mfp-with-anim mfp-hide">You may put any HTML here. This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate the look and feel of finished, typeset text. Only for show. He who searches for meaning here will be sorely disappointed.</div>
	</body>
</html>
<script>
// Inline popups
$('#inline-popups').magnificPopup({
  delegate: 'a',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});
// Image popups
$('#image-popups').magnificPopup({
  delegate: 'a',
  type: 'image',
  removalDelay: 500, //delay removal by X to allow out-animation
  callbacks: {
    beforeOpen: function() {
      // just a hack that adds mfp-anim class to markup 
       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
       this.st.mainClass = this.st.el.attr('data-effect');
    }
  },
  closeOnContentClick: true,
  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
});
// Hinge effect popup
$('a.hinge').magnificPopup({
  mainClass: 'mfp-with-fade',
  removalDelay: 1000, //delay removal by X to allow out-animation
  callbacks: {
    beforeClose: function() {
        this.content.addClass('hinge');
    }, 
    close: function() {
        this.content.removeClass('hinge'); 
    }
  },
  midClick: true
});
</script>