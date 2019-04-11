let draw = {
    setDraw: {
        mx: 0,
        my: 0,
        store: [],
        storeProcess: -1,
        color: "black",

    },
    tool: {
        edge: "butt",
        text: null,
        priorButton: null,
        distance: null,
        initX: null,
        initY: null,
        mouseX: null,
        mouseY: null,

    },
    bol: {
        mouseDown: false,
        tamp: 1, //1: not, 2:stamp pop, 3:mouse position prepared,
        drawMode: 1, //1:not, 2:draw, 3:erase, 4:text, 5:drawRect, 6: drawArc, 7: clone stamp tool
    }
};

(function() {
    //initialize
    let canvas = document.getElementById('myCanvas');
    let ctx = canvas.getContext('2d');
    let eraser = document.getElementById('eraser');
    let pencil = document.getElementById('pencil');
    let eraser_style = document.getElementById('eraser-style');
    let download = document.getElementById('download');
    let undo = document.getElementById('undo');
    let redo = document.getElementById('redo');
    let size = document.getElementById('size');
    let edge = document.getElementById('edge');
    let p = document.getElementsByClassName('p');
    let word = document.getElementById('word');
    let square = document.getElementById('square');
    let circle = document.getElementById('circle');
    let imitate = document.getElementById('imitate');
    let upload = document.getElementById('upload');
    let uploadInput = document.querySelector('input[type=file]');
    let font_type = document.getElementById('font-type');
    let submit = document.querySelector('button[type=submit]');
    let content = document.getElementById('content');
    let part = document.getElementsByClassName('part');
    let color = document.getElementById('color');

    if (p[0].innerHTML == 1) {
        p[0].innerHTML = "01";
    }
    //error event
    document.getElementById("error-sub").onclick = function(){
        document.getElementById("error-container").style.display = "none";
    }

    //detect device width
    if(window.innerHeight <= canvas.offsetTop + canvas.height && window.innerWidth > 767){
        canvas.height = window.innerHeight - canvas.offsetTop;
        canvas.style.marginBottom = "0";
    }


    //events
    download.onclick = function() {
        document.getElementById('download_a').setAttribute('href', canvas.toDataURL("image/png"));
    };

    undo.onclick = function() {
        let imag = new Image();
        if (draw.setDraw.storeProcess > 0) {
            draw.setDraw.storeProcess--;
            imag.src = draw.setDraw.store[draw.setDraw.storeProcess];
            imag.onload = function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(imag, 0, 0);
            };
        } else {
            if (draw.setDraw.store.length < 8) {
                draw.setDraw.storeProcess = -1;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            } else {
                draw.setDraw.storeProcess = 0;
                imag.src = draw.setDraw.store[draw.setDraw.storeProcess];
                imag.onload = function() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(imag, 0, 0);
                }
            }
        }
    };

    redo.onclick = function() {
        if (draw.setDraw.storeProcess < draw.setDraw.store.length - 1) {
            draw.setDraw.storeProcess++;
            let imag = new Image();
            imag.src = draw.setDraw.store[draw.setDraw.storeProcess];
            imag.onload = function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(imag, 0, 0);
            };
        }
    };

    size.onchange = function() {
        p[0].innerHTML = ("0" + size.value).slice(-2);
    };

    edge.onclick = function() {
        if (edge.value == "圓頭") {
            draw.tool.edge = "round";
        } else {
            draw.tool.edge = "butt";
        }
    };

    eraser.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 3;
        document.body.style.cursor = "grabbing";
    };
    pencil.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 2;
        document.body.style.cursor = "default";
    };

    square.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 5;
        document.body.style.cursor = "move";
    }

    circle.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 6;
        document.body.style.cursor = "move";
    }

    word.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 4;
        document.body.style.cursor = "text";
        part[0].classList.add("visible");

    };

    submit.onclick = function() {
        draw.tool.text = content.value;
    };

    imitate.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        draw.bol.drawMode = 7;
        document.body.style.cursor = "cell";
        part[1].classList.add("visible");
    }

    upload.onclick = function() {
        detectButton();
        draw.tool.priorButton = this.id;

        uploadInput.click();
    };

    uploadInput.onchange = function() {
        let reader = new FileReader();
        let img = new Image();
        reader.onload = function() {
            img.src = reader.result;
        };
        if (uploadInput.files[0]) {
            reader.readAsDataURL(uploadInput.files[0]);
            if (reader.readyState == 1) {
                let inter = setInterval(function() {
                    if (reader.readyState == 2) {
                        ctx.drawImage(img, 0, 0);
                        store();
                        clearInterval(inter);
                    }
                }, 100);
            }
        }
    };

    color.onchange = function() {
        draw.setDraw.color = this.value;
    }

    //mouse events
    canvas.onmousedown = function(e) {
        if (draw.bol.drawMode == 2) {
            ctx.beginPath();
            ctx.strokeStyle = draw.setDraw.color;
            ctx.lineWidth = size.value;
            ctx.lineCap = draw.tool.edge;
            draw.setDraw.mx = e.clientX - canvas.offsetLeft;
            draw.setDraw.my = e.clientY - canvas.offsetTop;
            ctx.moveTo(draw.setDraw.mx, draw.setDraw.my);
        }

        if (draw.bol.drawMode == 4 && draw.tool.text) {
            ctx.fillStyle = draw.setDraw.color;
            ctx.font = size.value + "px " + font_type.value;
            ctx.fillText(draw.tool.text, e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
            store();
        }

        if (draw.bol.drawMode == 5 || draw.bol.drawMode == 6) {
            draw.tool.initX = e.clientX - canvas.offsetLeft;
            draw.tool.initY = e.clientY - canvas.offsetTop;
        }

        if (draw.bol.drawMode == 7) {
            document.onkeydown = function(event) {
                if (event.keyCode == 18 && draw.bol.tamp != 2) {

                    draw.tool.initX = e.clientX; //滑鼠初始位置
                    draw.tool.initY = e.clientY;
                    eraser_style.style.display = "block";
                    eraser_style.style.backgroundColor = "transparent";
                    eraser_style.style.left = e.clientX + "px";
                    eraser_style.style.top = e.clientY + "px";
                    eraser_style.style.width = size.value + "px";
                    eraser_style.style.height = size.value + "px";
                    draw.bol.tamp = 2;
                }
            }

            if (draw.bol.tamp == 2) {
                draw.tool.mouseX = e.clientX - canvas.offsetLeft; //滑鼠在canvas位置
                draw.tool.mouseY = e.clientY - canvas.offsetTop;
                draw.bol.tamp = 3;
            }
        }
        draw.bol.mouseDown = true;
    };

    canvas.onmousemove = function(e) {
        draw.setDraw.mx = e.clientX - canvas.offsetLeft;
        draw.setDraw.my = e.clientY - canvas.offsetTop;
        if (draw.bol.drawMode == 2 && draw.bol.mouseDown) {
            ctx.lineTo(draw.setDraw.mx, draw.setDraw.my);
            ctx.stroke();
        }

        if (draw.bol.drawMode == 3 && draw.bol.mouseDown) {
            e.preventDefault();
            eraser_style.style.display = "block";
            eraser_style.style.left = e.clientX + "px";
            eraser_style.style.top = e.clientY + "px";
            eraser_style.style.width = size.value + "px";
            eraser_style.style.height = size.value + "px";
            ctx.clearRect(draw.setDraw.mx, draw.setDraw.my, size.value, size.value);
        }

        if (draw.bol.drawMode == 5 && draw.bol.mouseDown) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (draw.setDraw.storeProcess > -1) {
                let img = new Image();
                img.src = draw.setDraw.store[draw.setDraw.storeProcess];
                ctx.drawImage(img, 0, 0);
            }
            ctx.fillStyle = draw.setDraw.color;
            ctx.fillRect(draw.tool.initX, draw.tool.initY, draw.setDraw.mx - draw.tool.initX, draw.setDraw.my - draw.tool.initY);
        }

        if (draw.bol.drawMode == 6 && draw.bol.mouseDown) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (draw.setDraw.storeProcess > -1) {
                let img = new Image();
                img.src = draw.setDraw.store[draw.setDraw.storeProcess];
                ctx.drawImage(img, 0, 0);
            }
            draw.tool.distance = Math.sqrt(Math.pow(draw.setDraw.mx - draw.tool.initX, 2) + Math.pow(draw.setDraw.my - draw.tool.initY, 2));
            ctx.beginPath();
            ctx.fillStyle = draw.setDraw.color;
            ctx.arc(draw.tool.initX, draw.tool.initY, draw.tool.distance, 0, 2 * Math.PI);
            ctx.fill();
        }
        if (draw.bol.drawMode == 7 && draw.bol.tamp == 3) {
            let disX = draw.setDraw.mx - draw.tool.mouseX; //目前滑鼠位置與壓下距離
            let disY = draw.setDraw.my - draw.tool.mouseY;
            eraser_style.style.left = draw.tool.initX + disX + "px";
            eraser_style.style.top = draw.tool.initY + disY + "px";
            eraser_style.style.width = size.value + "px";
            eraser_style.style.height = size.value + "px";
            if (draw.bol.mouseDown) {
                ctx.putImageData(ctx.getImageData(draw.tool.initX - canvas.offsetLeft + disX, draw.tool.initY - canvas.offsetTop + disY, size.value, size.value), draw.setDraw.mx, draw.setDraw.my);
            }
        }
    };

    canvas.onmouseup = function(e) {
        if (draw.bol.drawMode == 3 && draw.bol.mouseDown) {
            eraser_style.style.display = "none";
        }
        draw.bol.mouseDown = false;
        store();
    };

    eraser_style.onmouseup = function(e) {
        if (draw.bol.drawMode == 3) {
            draw.bol.mouseDown = false;
            eraser_style.style.display = "none";
            store();
        }
    };

    //function

    function store() {
        draw.setDraw.storeProcess++;
        draw.setDraw.store.push(canvas.toDataURL("image/png"));
        if (draw.setDraw.store.length > 10) {
            draw.setDraw.store = draw.setDraw.store.slice(1);
            draw.setDraw.storeProcess--;
        }
    }

    function detectButton() {
        if (draw.tool.priorButton == "word") {
            draw.tool.text = null;
            content.value = "";
            part[0].classList.remove("visible");
        }
        if (draw.tool.priorButton == "imitate") {
            eraser_style.style.display = "none";
            draw.bol.tamp = 1;
            eraser_style.style.backgroundColor = "white";
            part[1].classList.remove("visible");
        }
    }
})();