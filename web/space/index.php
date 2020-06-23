<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>

<style>
.box{
	display:none;
	text-align: center;
	width:100%;
	height: 90%;
}
.sel{
	display:block;
}
</style>
<script>
function tt(x){
	$(".sel").removeClass("sel");
	$("#"+x).addClass("sel");
}
</script>
	<button id='b1' onclick='tt("t1")'>1</button>
	<button id='b2' onclick='tt("t2")'>2</button>
	<button id='b3' onclick='tt("t3")'>3</button>
	
<div class='box' id='t1' style='background-color:#f00;'>

</div>
<div class='box' id='t2' style='background-color:#0f0;'>

</div>
<div class='box' id='t3' style='background-color:#00f;'>

</div>
