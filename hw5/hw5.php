<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
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
		    font-size: 20px;
		    margin: 0.2em ;
		}
		.square {
		    width: 240px;
		    margin: auto;
		    display: flex;
		    flex-wrap: wrap;
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
		}
		#eval {
			width: 110px;
		}
	</style>
</head>
<body>
	<div class="container-style">
		<input id="inputNum" value=
			<?php
				session_start();
				$count = null;
				$showError = false;
				isset($_POST['0'])? $count = '0': $count;
				isset($_POST['1'])? $count = '1': $count;
				isset($_POST['2'])? $count = '2': $count;
				isset($_POST['3'])? $count = '3': $count;
				isset($_POST['4'])? $count = '4': $count;
				isset($_POST['5'])? $count = '5': $count;
				isset($_POST['6'])? $count = '6': $count;
				isset($_POST['7'])? $count = '7': $count;
				isset($_POST['8'])? $count = '8': $count;
				isset($_POST['9'])? $count = '9': $count;
				isset($_POST['add'])? $count = '+': $count;
				isset($_POST['substract'])? $count = '-': $count;
				isset($_POST['multiply'])? $count = '*': $count;
				isset($_POST['division'])? $count = '/': $count;
				isset($_POST['dot'])? $count = '.': $count;
				isset($_POST['left'])? $count = '(': $count;
				isset($_POST['right'])? $count = ')': $count;
				isset($_POST['back'])? $_SESSION['i'] = substr($_SESSION['i'], 0, -1): $count;
				isset($_POST['clear'])? $_SESSION['i'] = '': $count;

				if(isset($_POST['equal'])){
					try{
						eval('$_SESSION[\'i\'] = (' .$_SESSION['i'].');');
					}catch(\Throwable $e){
						$showError = true;
						$_SESSION['i'] = '';
					}
				}

				if(isset($_POST['sin'])){					
					try{
						eval('$_SESSION[\'i\'] = (' .$_SESSION['i'].');');
						$_SESSION['i'] = sin($_SESSION['i'] * pi() / 180);
					}catch(\Throwable $e){
						$showError = true;
						$_SESSION['i'] = '';
					}
				} 
				if(isset($_POST['cos'])){					
					try{
						eval('$_SESSION[\'i\'] = (' .$_SESSION['i'].');');
						$_SESSION['i'] = cos($_SESSION['i'] * pi() / 180);
					}catch(\Throwable $e){
						$showError = true;
						$_SESSION['i'] = '';
					}
				} 
				if(isset($_POST['tan'])){					
					try{
						eval('$_SESSION[\'i\'] = (' .$_SESSION['i'].');');
						$_SESSION['i'] = tan($_SESSION['i'] * pi() / 180);
					}catch(\Throwable $e){
						$showError = true;
						$_SESSION['i'] = '';
					}
				}  

				$_SESSION['i'] = isset($_SESSION['i']) ? $_SESSION['i'] = $_SESSION['i'].$count : '';

				if($_SESSION['i'] == ''){
					$_SESSION['i'] = '0';
				}
				if(strlen($_SESSION['i']) > 1 && substr($_SESSION['i'], 0, 1) == '0' ){
					$_SESSION['i'] = substr($_SESSION['i'], 1);
					if(substr($_SESSION['i'], 0, 1) == '.'){
						$_SESSION['i'] = "0".$_SESSION['i'];
					}
				}

	        	echo "'".$_SESSION['i']."'";
			?>
		disabled />
        <div class="square">
        	<form method="post" action="hw5.php">
	            <input id="cos" type="submit" value="cos" name="cos">
	            <input id="sin" type="submit" value="sin" name="sin">
	            <input id="tan" type="submit" value="tan" name="tan">
	            <input id="clear" type="submit" value="C" name="clear">
	            <input id="left" type="submit" value="(" name="left">
	            <input id="right" type="submit" value=")" name="right">
	            <input id="back" type="submit" value="←" name="back">
	            <input id="plus" type="submit" value="+" name="add">
	            <input id="seven" type="submit" value="7" name="7">
	            <input id="eight" type="submit" value="8" name="8">
	            <input id="nine" type="submit" value="9" name="9">
	            <input id="delete" type="submit" value="-" name="substract">
	            <input id="four" type="submit" value="4" name="4">
	            <input id="five" type="submit" value="5" name="5">
	            <input id="six" type="submit" value="6" name="6">
	            <input id="multiply" type="submit" value="×" name="multiply">
	            <input id="one" type="submit" value="1" name="1">
	            <input id="two" type="submit" value="2" name="2">
	            <input id="three" type="submit" value="3" name="3">
	            <input id="div" type="submit" value="÷" name="division">
	            <input id="dot" type="submit" value="." name="dot">
	            <input id="zero" type="submit" value="0" name="0">
	            <input id="eval" type="submit" value="=" name="equal">
            </form>
        </div>
    </div>
    <?php
    	if($showError == true){
    		echo '<script type="text/javascript">alert("Error");</script>';
    	}
    ?>
</body>
</html>