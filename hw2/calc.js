let input = document.getElementById("inputNum");
let inputSec = document.getElementById("inputNumAdd");
let evall = document.getElementById("eval");
let dot = document.getElementById("dot");
let zero = document.getElementById("zero");
let one = document.getElementById("one");
let two = document.getElementById("two");
let three = document.getElementById("three");
let four = document.getElementById("four");
let five = document.getElementById("five");
let six = document.getElementById("six");
let seven = document.getElementById("seven");
let eight = document.getElementById("eight");
let nine = document.getElementById("nine");
let plus = document.getElementById("plus");
let del = document.getElementById("delete");
let multiply = document.getElementById("multiply");
let division = document.getElementById("div");
let back = document.getElementById("back");
let cls = document.getElementById("C");
let left = document.getElementById("left");
let right = document.getElementById("right");
let sin = document.getElementById("sin");
let cos = document.getElementById("cos");
let tan = document.getElementById("tan");
let log = document.getElementById("log");
let madd = document.getElementById("madd");
let mdel = document.getElementById("mdel");
let mr = document.getElementById("mr");
let mc = document.getElementById("mc");

let initialInputNotSec = false;
let getSign = false;
let AccumulateEqual = false;
let accumulate;
let memory = "";

//螢幕鍵盤模式
zero.onclick = function() {
    forInput("0");
    zero.blur();
};

one.onclick = function() {
    forInput("1");
    one.blur();
};
two.onclick = function() {
    forInput("2");
    two.blur();
};
three.onclick = function() {
    forInput("3");
    three.blur();
};
four.onclick = function() {
    forInput("4");
    four.blur();
};
five.onclick = function() {
    forInput("5");
    five.blur();
};
six.onclick = function() {
    forInput("6");
    six.blur();
};
seven.onclick = function() {
    forInput("7");
    seven.blur();
};
eight.onclick = function() {
    forInput("8");
    eight.blur();
};
nine.onclick = function() {
    forInput("9");
    nine.blur();
};
dot.onclick = function() {
    forInput(".");
    dot.blur();
};
plus.onclick = function() {
    forCount("+");
    plus.blur();
};
del.onclick = function() {
    forCount("-");
    del.blur();
};
multiply.onclick = function() {
    forCount("*");
    multiply.blur();
};
division.onclick = function() {
    forCount("/");
    division.blur();
};
cls.onclick = function() {
    inputSec.value = "";
    input.value = "0";
    cls.blur();
};
back.onclick = function() {
    let wholeCha = input.value.length;
    input.value = input.value.substring(0, wholeCha - 1);
    if (input.value == "") {
        input.value = "0";
    }
    back.blur();
};
evall.onclick = function() {
    if (inputSec.value == "" && AccumulateEqual == true) { //如果sub為空且可開始連續=
        for (var i = accumulate.length; i >= 0; i--) {
            if ("+" == accumulate[i] || "-" == accumulate[i] || "*" == accumulate[i] || "/" == accumulate[i] && getSign == true) {
                accumulate = accumulate.substring(i);
            } //如果有+-...在字串[i]中且未取得+-...
        }
        input.value = eval(input.value += accumulate);
        getSign = false; // 已取得+-...
        AccumulateEqual = true; //可連續=
        evall.blur();
    } else if (inputSec.value != "" && AccumulateEqual == false) { //如果sec不為空且不可連續=
        try {

            inputSec.value += input.value;
            accumulate = inputSec.value; //取得要計算的值以供連續=
            input.value = eval(inputSec.value);
        } catch (Error) {
            alert("Error");
            input.value = "0";
        } finally {
            inputSec.value = "";
            initialInputNotSec = false; //不清空input,可輸至sec
            getSign = true; //可開始抓+-...
            AccumulateEqual = true; // 可開始連續=
            evall.blur();
        }
    }
};

left.onclick = function() {
    forInput("(");
    left.blur();
};
right.onclick = function() {
    forInput(")");
    right.blur();
};
sin.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.sin(eval(inputSec.value) * Math.PI / 180);
    inputSec.value = "";
    initialInput = false;
    sin.blur();
};
cos.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.cos(eval(inputSec.value) * Math.PI / 180);
    inputSec.value = "";
    initialInput = false;
    cos.blur();
};
tan.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.tan(eval(inputSec.value) * Math.PI / 180);
    inputSec.value = "";
    initialInput = false;
    tan.blur();
};
log.onclick = function() {
    if (input.value != "0") {
        inputSec.value += input.value;
        input.value = Math.log10(eval(inputSec.value));
        inputSec.value = "";
        initialInput = false;
        log.blur();
    }
};

madd.onclick = function() {
    memory += "+" + input.value;
    madd.blur();
};
mdel.onclick = function() {
    memory += -input.value;
    mdel.blur();
};

mc.onclick = function() {
    memory = "";
    mc.blur();
};

mr.onclick = function() {
    if (memory != "") {
        if (initialInputNotSec == true) { //可清空input
            input.value = eval(memory);
            initialInputNotSec = false; //不清空input
        } else {
            input.value = eval(memory);
        }
    }
    mr.blur();
};

//鍵盤模式
document.addEventListener("keyup", keyDown);

function keyDown(e) {
    let keyNum = e.keyCode;
    switch (keyNum) {
        case 48:
            forInput("0");
            setColor(zero);
            break;
        case 49:
            forInput("1");
            setColor(one);
            break;
        case 50:
            forInput("2");
            setColor(two);
            break;
        case 51:
            forInput("3");
            setColor(three);
            break;
        case 52:
            forInput("4");
            setColor(four);
            break;
        case 53:
            forInput("5");
            setColor(five);
            break;
        case 54:
            forInput("6");
            setColor(six);
            break;
        case 55:
            forInput("7");
            setColor(seven);
            break;
        case 56:
            forInput("8");
            setColor(eight);
            break;
        case 57:
            forInput("9");
            setColor(nine);
            break;
        case 190:
            forInput(".");
            setColor(dot);
            break;
        case 107:
            forCount("+");
            setColor(plus);
            break;
        case 109:
            forCount("-");
            setColor(del);
            break;
        case 106:
            forCount("*");
            setColor(multiply);
            break;
        case 111:
            forCount("/");
            setColor(division);
            break;
        case 8:
            // 後退
            let wholeCha = input.value.length;
            input.value = input.value.substring(0, wholeCha - 1);
            if (input.value == "") {
                input.value = "0";
            }
            setColor(back);
            break;
        case 46:
            input.value = "0";
            inputSec.value = "";
            setColor(cls);
            break;
        case 13:
            setColor(evall);
            if (inputSec.value == "" && AccumulateEqual == true) { //如果sub為空且可開始連續=
                for (var i = accumulate.length; i >= 0; i--) {
                    if ("+" == accumulate[i] || "-" == accumulate[i] || "*" == accumulate[i] || "/" == accumulate[i] && getSign == true) {
                        accumulate = accumulate.substring(i);
                    } //如果有+-...在字串[i]中且未取得+-...
                }
                input.value = eval(input.value += accumulate);
                getSign = false; // 已取得+-...
                AccumulateEqual = true; //可連續=
                evall.blur();
            } else if (inputSec.value != "" && AccumulateEqual == false) { //如果sec不為空且不可連續=
                try {
                    inputSec.value += input.value;
                    accumulate = inputSec.value; //取得要計算的值以供連續=
                    input.value = eval(inputSec.value);
                } catch (Error) {
                    alert("Error");
                    input.value = "0";
                } finally {
                    inputSec.value = "";
                    initialInputNotSec = false; //不清空input,可輸至sec
                    getSign = true; //可開始抓+-...
                    AccumulateEqual = true; // 可開始連續=
                    evall.blur();
                }
            }
            break;
    }
}

//初始化為0
if (input.value == "") {
    input.value = "0";
}

//消除0
function checkZero() {
    let allNum = input.value.length;
    if (allNum > 1 && input.value[0] == "0" && input.value[1] != ".") {
        input.value = input.value.substring(1);
    }
}

//計算時的換行機制
function forInput(Num) {
    if (initialInputNotSec == true) { //清空input  //3
        input.value = "";
        input.value += Num;
        checkZero();
        initialInputNotSec = false; //不清空input,可輸至sec
    } else { //1
        input.value += Num;
        checkZero();
    }
}

function forCount(count) {
    if (initialInputNotSec == false) { //不清空input, 可輸至sec   //2
        inputSec.value += input.value;
        inputSec.value += count;
        initialInputNotSec = true; //可清空input
        AccumulateEqual = false; //不可連續=
    } else if (initialInputNotSec == true && count != inputSec.value[inputSec.value.length - 1]) { //不可加入sub但可替換+-..
        inputSec.value = inputSec.value.substring(0, inputSec.value.length - 1);
        inputSec.value += count;
    }
}

//變更顏色
function setColor(element) {
    let choosecolor = element.style.backgroundColor;
    if (element == evall) {
        element.style.backgroundColor = "#FF1F1F";
        setTimeout(() => element.style.backgroundColor = choosecolor, 200);
    } else {
        element.style.backgroundColor = "#FD4C49";
        setTimeout(() => element.style.backgroundColor = choosecolor, 200);
    }
}