<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
  <title>NBA DATABASE</title>

<style>
#header {
  background-color:black;
  color:white;
  text-align:center;
  padding:7px;
}

body {
  background: url(./pictures/bg3.jpg) no-repeat center center fixed;
  /*兼容浏览器版本*/
  -webkit-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

.container {
  position: relative;
  margin: 0 auto;
  width: 100%;
  max-width: 1000px;
}

.container1 {
  position: relative;
  width: 100%;
  max-width: 400px;
  float:left;
}
.container2 {
  position: relative;
  width: 100%;
  max-width: 400px;
  float:right;
}

.container img {
  width: 100%;
  height: auto;
  border-radius: 20px;
}

.container .btn1 {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: white;
  color: black;
  font-size: 24px;
  padding: 12px 26px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn2 {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: gold;
  color: black;
  font-size: 24px;
  padding: 12px 26px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn1:hover {
  background-color: black;
  color: white;
}

.container .btn2:hover {
  background-color: black;
  color: gold;
}

</style>
</head>
<body background="./pictures/bg3.jpg">
<div id="header">
<h1>NBA DATABASE</h1>
</div>

<br>
<hr width=30% />
<h3 align="center" style="color:black">Choose your system</h3>
<hr width=30% />

<div class="container">
  <div class="container1">
    <img src="./pictures/Team.png" alt="Team" style="width:100%">
    <button class="btn1" onclick="location.href='Team.php'">Team</button>
  </div>
  <div class="container2">
    <img src="./pictures/Player.jpg" alt="Player" style="width:100%">
    <button class="btn2" onclick="location.href='Player.php'">Player</button>
  </div>
</div>

</body>
</html>