function showDivs(){
	var showId=document.getElementById('first');
	var showId2=document.getElementById('second');
	var showId3=document.getElementById('group_left');
	var showId4=document.getElementById('third');
	var clients=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight;
	var divTop=showId.getBoundingClientRect().top;
	var divTop2=showId.getBoundingClientRect().top;
	var divTop3=showId.getBoundingClientRect().top;
	var divTop4=showId.getBoundingClientRect().top;
	if(divTop<=clients){
	showId.classList.add("fadeInLeft");
    }
    if(divTop2<=clients){
	showId2.classList.add("fadeInRgith");
    }
    if(divTop3<=clients){
	showId3.classList.add("group_left");
    }
    if(divTop4<=clients){
	showId4.classList.add("third");
    }
}
window.onscroll=showDivs;