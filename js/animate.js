function showDivs(){
	var showId=document.getElementById('box1');
	var clients=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight;
	var divTop=showId.getBoundingClientRect().top;
	if(divTop<=clients){
	showId.classList.add("fadeInLeft");
    }
}
	window.onscroll=showDivs;