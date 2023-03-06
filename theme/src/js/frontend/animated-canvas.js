export const setUpCanvas = (elem) =>{
    var canvas = elem.querySelector('canvas');
    var ctx = canvas.getContext("2d");

    const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0)
    const w = Math.round( vw * .56 );

    //we want a square
    const h = w;
    canvas.width = w;
    canvas.height = h;

    const x_center = w / 2;
    const y_center = h / 2;

    //these variables determine how things look
    var loops = 8;
    var radius = 1; //this is your actual radius
    var step = w / loops; //100
    var looplimit = step * 2; // 200

    const colorone = canvas.dataset.canvasColorone; 
    const colortwo = canvas.dataset.canvasColortwo; 
    console.log(colorone);
    const foreground = canvas.dataset.foregroundImage;
    ctx.fillStyle = colorone; //blue
    ctx.fillRect(0,0, w, h);
    var img = document.createElement("img");
    img.classList.add("foreground");
    elem.id = "insertForeground";
    img.onload = function(){
        let parent = document.getElementById("insertForeground");
        parent.appendChild(img);
    }
    img.src = foreground;

    function drawLoop(){
        var iterations = 1;
        while(iterations < loops){
            ctx.fillStyle = ((iterations % 2) == 0) ? colorone : colortwo;
            ctx.beginPath();
            ctx.arc (x_center, y_center, radius + (h - step * iterations ), 0, 2*Math.PI);
            ctx.closePath();
            ctx.fill();
            iterations++;
        }
        //draw the offset/radius base arc
        ctx.fillStyle = ((iterations % 2) == 0) ? colorone : colortwo;
        ctx.beginPath();
        ctx.arc (x_center, y_center, radius, 0, 2*Math.PI);
        ctx.closePath();
        ctx.fill();
        
        if(radius > step ){
            ctx.fillStyle = colortwo;
            ctx.beginPath();
            ctx.arc (x_center, y_center, radius - step, 0, 2*Math.PI);
            ctx.closePath();
            ctx.fill();
        }
        radius++;
        if(radius<looplimit){
        requestAnimationFrame(drawLoop)
        } else {
        radius = 1;
        requestAnimationFrame(drawLoop);
        }

    }
    drawLoop();
}

export const setUpSlide = (elem) => {
    
    // const sizes = ['tiny', 'small', 'medium', 'large'];
    // class Banana {
    
    //     constructor( parent ){
    //       console.log(parent);
    //       console.log(parent.scrollWidth);
    //       this.x = Math.round(Math.random() * parent.scrollWidth);
    //       this.y = Math.round(Math.random() * parent.scrollHeight );
    //       this.imgsize = Math.round( Math.random() * 3 + 1); //random between 1 & 4
    //       this.flipped = Math.random() < 0.5;
    //       this.directionX = Math.random() < 0.5 ? -1 : 1;
    //       this.directionY = Math.random() < 0.5 ? -1 : 1;
    //       this.rotation = Math.round( Math.random() * 90 + 1);
    //       this.direction = Math.round( Math.random() * 3 ); //random between 0 & 3
    //       this.newBanana(parent,  this.x, this.y, this.imgsize, this.flipped, this.rotation, this.directionX, this.directionY)
          
    //     }
    //     newBanana( parent, x,y, size, flipped, rotation, directionx, directiony ){
    //       let banana = document.createElement("SPAN");
    //       let bananaouter = document.createElement("SPAN");
    //       let sizeclass = sizes[size];
    //       bananaouter.classList.add("bananaouter");
    //       bananaouter.setAttribute('style', 'top:' + y + 'px;' + 'left:' + x + 'px;')
    //       banana.classList.add("banana")
    //       if(flipped) banana.classList.add("flipped");
    //       banana.classList.add(sizeclass);
    //       bananaouter.setAttribute('data-move-x', directionx);
    //       bananaouter.setAttribute('data-move-y', directiony);
    //       banana.setAttribute('style', 'transform: rotate('+ (rotation * directionx) +'deg);');
    //       bananaouter.appendChild(banana);
    //       parent.appendChild(bananaouter)
    //     }
    // }
    // const itsbananas = [];
    // const allbananas = Math.round( Math.random() * 15);
    // const holder = document.createElement('div');
    // holder.classList.add('hammock');
    // for(let i=0;i<allbananas;i++) itsbananas.push( new Banana(holder) );
    // elem.appendChild(holder);
    
}