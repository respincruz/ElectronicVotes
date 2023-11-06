<!DOCTYPE html>
<html>
<body>

<canvas id="myCanvas" width="200" height="100"
style="border:1px solid #d3d3d3; padding:10px 80px; background-color: #fec839;">
Your browser does not support the canvas element.
</canvas>

<script>
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
ctx.font = "30px Arial";
ctx.fillStyle="#861031";
var a=Math.floor(Math.random()*100);
var b=Math.floor(Math.random()*100);

localStorage.setItem("captcha",a+b );
console.log(localStorage.getItem("captcha"));
ctx.fillText(a+"+"+b+"=?",40,50);
</script>

</body>
</html>