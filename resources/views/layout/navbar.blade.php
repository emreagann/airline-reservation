
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  
.navbar {
  overflow: hidden;
  background-color: #333;
  font-family: Arial, Helvetica, sans-serif;
  padding: 0;
  margin: 0;
  justify-content: start;
}
.navbar a {
  display: inline-flex;
  align-items: center;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 15px 8px; 
  text-decoration: none;
  height: 50px;
  margin-right: 4px; 
}

.navbar a:last-child {
  margin-right: 0; 
}
.navbar a i {
  margin-right: 5px;
}
* {
  box-sizing: border-box;
}
body {
  margin: 0;
}
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}
</style>
     <div class="navbar">
  <a style="font-weight: bold" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
  <a style="font-weight: bold;" href="{{ url('passenger') }}"><i class="fa fa-user"></i> Passenger</a>
  <a style="font-weight: bold;" href="{{ url( 'flightmaster') }}"><i class="fa fa-plane"></i> Flight</a>
  <a style="font-weight: bold;" href="{{ url('booking') }}"><i class="fa fa-ticket"></i> Booking</a>
</div>
