<li><a href="{{ url('/category') }}">Category</a></li>

<li><a href="{{ url('/color') }}">Color</a></li>

<li><a href="{{ url('/services') }}">Additional Service(s)</a></li>

<li><a href="{{ url('/customer') }}">Customer</a></li>

<li><a href="{{ url('/stock') }}">Stock</a></li>

<li><a href="{{ url('/returnstock') }}">Return Stock</a></li>

<li><a href="{{ url('/tag') }}">Print Tag</a></li>

@if(\Auth::User()->type == 0)
<li><a href="{{ url('/worker') }}">worker</a></li>
@endif

<li>
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn btn btn-link" style="color: #ccc;">Report</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="{{ url('/clothesin') }}">cloth(es) in</a>
    <a href="{{ url('/clothesout') }}">cloth(es) out</a>
    <a href="{{ url('/income') }}">Income generated</a>
    <a href="#contact">Contact</a>
  </div>
</div>
</li>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<style>
/**.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
} **/

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>