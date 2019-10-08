 </div>
        <div class="container">
	<img class="myslider" src="img/vote.jpeg" style="width: 100%">
	<img class="myslider" src="img/vote4.jpeg" style="width: 100%">
	<img class="myslider" src="img/vote1.jpg" style="width: 100%">

		<a class="icon left" onclick="getdiv(-1)">&#10094</a>
		<a class="icon right" onclick="getdiv(1)">&#10095</a>
	</div>
	<script>
		var index=1;
		showdiv(index);
		function getdiv(n){
			showdiv(index +=n);
		}

		function showdiv(n){
			var i;
			var a=document.getElementsByClassName("myslider");
			if(n > a.length){
				index=1;
			}
			if(n<1){
				index=a.length;
			}
			for(i=0;i<a.length;i++){
				a[i].style.display="none";
			}

			a[index-1].style.display="block"
		}
	</script>
