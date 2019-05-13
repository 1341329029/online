function showDivs(){
	var showId=document.getElementById('box2');
	var showId1=document.getElementById('box3');
	var showId2=document.getElementById('box4');
	var clients=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight;
	var divTop=showId.getBoundingClientRect().top;
	var divTop1=showId1.getBoundingClientRect().top;
	var divTop2=showId2.getBoundingClientRect().top;
	if(divTop<=clients){
	showId.classList.add("fadeInRight");
    }
    if(divTop1<=clients){
	showId1.classList.add("fadeInLeft");
    }
    if(divTop2<=clients){
	showId2.classList.add("fadeInRight");
    }
}
	window.onscroll=showDivs;