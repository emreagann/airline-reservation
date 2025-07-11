
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Airline Reservation System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}
.column {
  float: left;
  width: 33.33%;
  padding: 10px;
  background-color: #ccc;
  height: 250px;
}

.column a {
  float: none;
  color: black;
  padding: 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.column a:hover {
  background-color: #ddd;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    height: auto;
  }
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;  
}

.airplaneAnimation {
  position: relative; 
  width:400px;
  height:400px;
  border-radius:50%;
  background-color: #caf0f8;
  overflow: hidden;
}
.plane {
  position: relative;
  left:0;
  top:75px;
  animation: fly 2s linear infinite;
}

.main {
  position: absolute;
  width: 220px;
  height: 40px;
  background-color: #0077b6;
  top:100px;
  left:100px;
  border-radius: 0 100px 30px 100px; 
  overflow:hidden;
  box-shadow: inset -10px -10px rgba(0,0,0,0.2);
  z-index:2;
}

.main:before, .main:after {
  content:"";
  position: absolute;
  background-color: #fdc921;
  top:10px;
}

.main:before {
  width:40px;
  height:10px;
  border-radius: 0 0 0 30px;
  left: 190px;
}

.main:after {
  width: 5px;
  height: 10px;
  border-radius:20px;
  left:160px;
  box-shadow: -10px 0 #fdc921,-20px 0 #fdc921, -30px 0 #fdc921, -40px 0 #fdc921, -50px 0 #fdc921, -60px 0 #fdc921, -70px 0 #fdc921, -80px 0 #fdc921, -90px 0 #fdc921, -100px 0 #fdc921, -110px 0 #fdc921, -120px 0 #fdc921;
}

.wingOne {
  position: absolute;
  width:20px;
  border-right: 20px solid transparent;
  border-left: 20px solid transparent;
  border-top: 80px solid #0077b6;
  height:0;
  top:115px;
  left:160px;
  transform: skew(-45deg) rotateX(30deg);
  z-index:4;
}

.wingTwo {
  position: absolute;
  width:20px;
  border-right: 20px solid transparent;
  border-left: 20px solid transparent;
  border-bottom: 80px solid #023e8a;
  height:0;
  top:55px;
  left:160px;
  transform: skew(45deg) rotateX(30deg);
}

.wingTwo:after {
  content:"";
  position: absolute; 
  width:20px;
  border-right: 15px solid transparent;
  border-left: 15px solid transparent;
  border-bottom: 35px solid #0077b6;
  height:0;
  left:-100px;
  top:29px;
}

.wingOne:after {
  content:"";
  position: absolute; 
  width:20px;
  height:25px;
  background-color: #0077b6;
  top:-105px;
  left:-140px;
  box-shadow: 5px 5px 10px rgba(0,0,0,0.2);
}

.wingTwo:before {
  content:"";
  position: absolute; 
  width:20px;
  height:25px;
  background-color: #023e8a;
  left:-80px;
  top:35px;
  transform: skew(-55deg);
}
.clouds {
  position: absolute;
  top:50px;
  left:100px;
}

@keyframes cloud {  
  from{ 
    left:-150px; 
  }
  to{ 
    left: 400px; 
  }
}

.cloudOne, .cloudTwo, .cloudThree {
  position: absolute;
  width: 50px;
  height: 25px;
  background-color: #fff;
  border-radius:100px 100px 0 0;
}

.cloudOne {
  top:0;
  left:0;
  animation: cloud 3s linear infinite reverse;
}

.cloudTwo {
  top:50px;
  left:100px;
  animation: cloud 2.5s linear infinite reverse;
}

.cloudThree {
  top:250px;
  left:50px;
  animation: cloud 2.8s linear infinite reverse;
}

.cloudOne:before, .cloudTwo:before, .cloudThree:before {
  content:"";
  position: absolute;
  width: 25px;
  height: 12.5px;
  background-color: #fff;
  border-radius:100px 100px 0 0;
  left:-20px;
  top:12.5px;
  box-shadow: 65px 0 #fff;
}


.pollution {
  position: absolute;
  background-color: #fff;
  top: 130px;
  left: 65px;
  width: 30px;
  height: 10px;
  border-radius: 20px;
  opacity: 0;
  animation: up 1s linear infinite;
}

.pollution:before, .pollution:after {
  content:"";
  position: absolute;
  background-color: #fff;
  border-radius:20px;
  opacity:0;
  width:30px;
  height:10px;
}
.pollution:after {
  top: 10px;
  left: -25px;
  animation: up 2s linear infinite;
}
.pollution:before {
  top: -10px;
  left: -35px;
  animation: up 3s linear infinite;
 
}
.plane-title {
  position: absolute;
  top: 70px;
  left: 50%;
  transform: translateX(-50%);
  color: #141314;
  font-size: 2rem;
  font-family: Arial, Helvetica, sans-serif;
  z-index: 10;
  text-shadow: 0 2px 8px #fff;
}
@keyframes up { 
    20% {opacity: 0.7;}
    35% {left: 100px opacity: 0.7;}
    70% {left: 70px  opacity: 0;} 
  }
</style>
</head>
<body>
  @include('layout.navbar')
<div class="container">
    <div class="plane-title"><h1>Airline Reservation System</h1></div>
<div class="airplaneAnimation">
  <div class="plane">
  <div class="main"></div>
  <div class="wingOne"></div>
  <div class="wingTwo"></div>
  <div class="pollution"></div>
  </div>
  <div class="clouds">
    <div class="cloudOne"></div>
    <div class="cloudTwo"></div>
    <div class="cloudThree"></div>
  </div>
</div>
</div>
</body>
</html>
