<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:image" content="https://raw.githubusercontent.com/chite/Resume/master/resources/icon1.png">
    <link rel="shortcut icon" type="image/png" href="https://raw.githubusercontent.com/chite/Resume/master/resources/icon1.png">
	<title>hw5</title>
	<style>
		.container-style {
			background-color: rgba(150, 150, 150, 0.2);
		    border: 1.5px solid #EBEBEB;
		    border-radius: 5px;
		    width: 250px;
		    height: 430px;
		    margin: auto;
		    margin-top: 10px;
		    padding: 5px;
		    text-align: center;
		    
		}
		#inputNum  {
		    background-color: black;
		    border: none;
		    border-radius: 10px;
		    width: 85%;
		    height: 40px;
		    color: white;
		    padding-right: 1em;
		    text-align: right;
		    font-weight: bold;
		    font-size: 1.5em;
		    margin: 0.2em ;
		    outline: none;
		}
		.square {
		    width: 240px;
		    margin: auto;
		}
		.square input {
		    border-radius: 5px;
		    width: 50px;
		    height: 50px;
		    margin: 3px;
		    margin-top: 10px;
		    background-color: #F15956;
		    color: white;
		    border: 0px;
		    font-weight: bold;
		    font-size: 1.5em;
		}
		#eval {
			width: 110px;
		}
	</style>
</head>
<body>
	<div class="container-style">
		<form method="post" action="hw5.php">
			<input id="inputNum" name="num" value=
				<?php
					$count = null;
					$showError = false;
					if(isset($_POST['num'])){
						$count = $_POST['num'];
						$countSplit = str_split($count, 1);
						if($countSplit[0] === '0'){ //避免轉換為八進位
							$countSplit = array_slice($countSplit, 1);
							$count = implode($countSplit);
						}
						foreach ($countSplit as $value) {
							$test = preg_match('/\d+|[.+*\/\-()]/i', $value); //regular expression
							if($test === 0){
								$showError = true;
								$count = '0';
							}
						}
					}
					
					if(isset($_POST['equal'])){
						try{
							eval('$count = (' .$count.');');
						}catch(\Throwable $e){ //抓出錯誤的語法
							$showError = true;
							$count = '0';
						}
					}

					if(isset($_POST['sin'])){					
						try{
							eval('$count = (' .$count.');');
							$count = sin($count * pi() / 180);
						}catch(\Throwable $e){
							$showError = true;
							$count = '0';
						}
					} 
					if(isset($_POST['cos'])){					
						try{
							eval('$count = (' .$count.');');
							$count = cos($count * pi() / 180);
						}catch(\Throwable $e){
							$showError = true;
							$count = '0';
						}
					} 
					if(isset($_POST['tan'])){					
						try{
							eval('$count = (' .$count.');');
							$count = tan($count * pi() / 180);
						}catch(\Throwable $e){
							$showError = true;
							$count = '0';
						}
					}  
			    	echo $count;
				?>
			 >
	        <div class="square">
	            <input id="cos" type="submit" value="cos" name="cos">
	            <input id="sin" type="submit" value="sin" name="sin">
	            <input id="tan" type="submit" value="tan" name="tan">
	            <input id="clear" type="button" value="C" name="clear">
	            <input id="left" type="button" value="(" name="left">
	            <input id="right" type="button" value=")" name="right">
	            <input id="back" type="button" value="←" name="back">
	            <input id="plus" type="button" value="+" name="add">
	            <input id="seven" type="button" value="7" name="7">
	            <input id="eight" type="button" value="8" name="8">
	            <input id="nine" type="button" value="9" name="9">
	            <input id="delete" type="button" value="-" name="substract">
	            <input id="four" type="button" value="4" name="4">
	            <input id="five" type="button" value="5" name="5">
	            <input id="six" type="button" value="6" name="6">
	            <input id="multiply" type="button" value="×" name="multiply">
	            <input id="one" type="button" value="1" name="1">
	            <input id="two" type="button" value="2" name="2">
	            <input id="three" type="button" value="3" name="3">
	            <input id="div" type="button" value="÷" name="division">
	            <input id="dot" type="button" value="." name="dot">
	            <input id="zero" type="button" value="0" name="0">
	            <input id="eval" type="submit" value="=" name="equal">
	        </div>
        </form>
    </div>
    <?php
    	if($showError == true){
    		echo '<script type="text/javascript">alert("Error");</script>';
    	}
    ?>
    <script type="text/javascript">
    	let input = document.getElementById("inputNum");
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
		let cls = document.getElementById("clear");
		let left = document.getElementById("left");
		let right = document.getElementById("right");

		input.onfocus = function(){
			if(input.value == "0"){
				input.value = "";
			}
		}
		input.onblur = function(){
			if(input.value == ""){
				input.value = "0";
			}
		}

		zero.onclick = function() {
		    input.value += "0";
		    zero.blur();
		    checkZero();
		};

		one.onclick = function() {
		    input.value += "1";
		    one.blur();
		    checkZero();
		};
		two.onclick = function() {
		    input.value += "2";
		    two.blur();
		    checkZero();
		};
		three.onclick = function() {
		    input.value += "3";
		    three.blur();
		    checkZero();
		};
		four.onclick = function() {
		    input.value += "4";
		    four.blur();
		    checkZero();
		};
		five.onclick = function() {
		    input.value += "5";
		    five.blur();
		    checkZero();
		};
		six.onclick = function() {
		    input.value += "6";
		    six.blur();
		    checkZero();
		};
		seven.onclick = function() {
		    input.value += "7";
		    seven.blur();
		    checkZero();
		};
		eight.onclick = function() {
		    input.value += "8";
		    eight.blur();
		    checkZero();
		};
		nine.onclick = function() {
		    input.value += "9";
		    nine.blur();
		    checkZero();
		};
		dot.onclick = function() {
		    input.value += ".";
		    dot.blur();
		};
		plus.onclick = function() {
		    input.value += "+";
		    plus.blur();
		    checkZero();
		};
		del.onclick = function() {
		    input.value += "-";
		    del.blur();
		    checkZero();
		};
		multiply.onclick = function() {
		    input.value += "*";
		    multiply.blur();

		};
		division.onclick = function() {
		    input.value += "/";
		    division.blur();
		};
		cls.onclick = function() {
		    input.value = "0";
		    cls.blur();
		    checkZero();
		};
		back.onclick = function() {
		    let wholeCha = input.value.length;
    		input.value = input.value.substring(0, wholeCha - 1);
    		if(input.value == ""){
    			input.value = "0";
    		}
		    back.blur();
		};
		left.onclick = function() {
		    input.value += "(";
		    left.blur();
		    checkZero();
		};
		right.onclick = function() {
		    input.value += ")";
		    right.blur();
		    checkZero();
		};
		
		if(input.value == ""){
			input.value = "0";
		}
		function checkZero() {
		    let allNum = input.value.length;
		    if (allNum > 1 && input.value[0] == "0" && input.value[1] != ".") {
		        input.value = input.value.substring(1);
		    }
		}
    </script>
</body>
</html>