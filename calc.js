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

let initialInput = false;
let accumulateBol = true;
let detectAccumulate = false;
let turnToSec = false;
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
    forCount("÷");
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
    if (inputSec.value == "" && detectAccumulate == true) {
        for (var i = accumulate.length; i >= 0; i--) {
            if ("+" == accumulate[i] || "-" == accumulate[i] || "*" == accumulate[i] || "÷" == accumulate[i] && accumulateBol == false) {
                accumulate = accumulate.substring(i);
            }
        }
        input.value = eval(input.value += accumulate);
        accumulateBol = true;
        detectAccumulate = true;
        evall.blur();
    } else if (inputSec.value != "" && detectAccumulate == false) {
        try {
            inputSec.value += input.value;
            accumulate = inputSec.value;
            input.value = eval(inputSec.value);
        } catch (Error) {
            alert("Error");
            input.value = "0";
            inputSec.value = "";
        } finally {
            inputSec.value = "";
            initialInput = false;
            accumulateBol = false; //新的=後可再連續=
            detectAccumulate = true;
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
    input.value = Math.sin(eval(inputSec.value));
    inputSec.value = "";
    initialInput = false;
    sin.blur();
};
cos.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.cos(eval(inputSec.value));
    inputSec.value = "";
    initialInput = false;
    cos.blur();
};
tan.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.tan(eval(inputSec.value));
    inputSec.value = "";
    initialInput = false;
    tan.blur();
};
log.onclick = function() {
    inputSec.value += input.value;
    input.value = Math.log10(eval(inputSec.value));
    inputSec.value = "";
    initialInput = false;
    log.blur();
};

madd.onclick = function() {
    memory += "+" + input.value;
    turnTosec = true;
};
mdel.onclick = function() {
    memory += -input.value;
    turnToSec = true;
};

mc.onclick = function() {
    memory = "";
};

mr.onclick = function() {
    if (memory != "") {
        if (initialInput == true) { //可清空input
            input.value = eval(memory);
            initialInput = false; //不清空input
            turnToSec = true; //可輸至sec
        } else {
            input.value = eval(memory);
            turnToSec = true; //可輸至sec
        }
    }
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
            forCount("÷");
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
            if (inputSec.value == "" && detectAccumulate == true) {
                for (var i = accumulate.length; i >= 0; i--) {
                    if ("+" == accumulate[i] || "-" == accumulate[i] || "*" == accumulate[i] || "÷" == accumulate[i] && accumulateBol == false) {
                        accumulate = accumulate.substring(i);
                    }
                }
                input.value = eval(input.value += accumulate);
                accumulateBol = true;
                detectAccumulate = true;
                evall.blur();
            } else if (inputSec.value != "" && detectAccumulate == false) {
                try {
                    inputSec.value += input.value;
                    accumulate = inputSec.value;
                    input.value = eval(inputSec.value);
                } catch (Error) {
                    alert("Error");
                    input.value = "0";
                    inputSec.value = "";
                } finally {
                    inputSec.value = "";
                    initialInput = false;
                    accumulateBol = false; //新的=後可再連續=
                    detectAccumulate = true;
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
    if (initialInput == true) { //清空input
        input.value = "";
        input.value += Num;
        checkZero();
        initialInput = false; //不清空input
        turnToSec = true; //可輸至sec
    } else {
        input.value += Num;
        turnToSec = true; //可輸至sec
        checkZero();
    }
}

function forCount(count) {
    if (turnToSec == true) { //可輸至sec
        inputSec.value += input.value;
        inputSec.value += count;
        initialInput = true; //可清空input
        detectAccumulate = false; //不可繼續抓取自串的+-..
        turnToSec = false; //不可輸至sec
    } else if (turnToSec == false && count != inputSec.value[inputSec.value.length - 1]) {
        inputSec.value = inputSec.value.substring(0, inputSec.value.length - 1);
        inputSec.value += count;
    }
}

//變更顏色
function setColor(element) {
    let choosecolor = element.style.backgroundColor;
    if (element == evall) {
        element.style.backgroundColor = "#FF6B7A";
        setTimeout(() => element.style.backgroundColor = choosecolor, 300);
    } else {
        element.style.backgroundColor = "#8FCDFF";
        setTimeout(() => element.style.backgroundColor = choosecolor, 300);
    }
}
