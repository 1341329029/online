window.onload=function(){
    var oDiv=document.getElementById('menu');
    var oDiv2=document.getElementById('picture_head');
    var oDiv3=document.getElementById('menu_top');
    oDiv2.onmousedown=function(){
        startMove(0);
    }

    oDiv2.onmouseup=function(){
        startMove(-230);
    }
    var timer=null;
    function startMove(iTarget){
        clearInterval(timer);

        timer=setInterval(function()
        {
            var speed=0;
            if(oDiv.offsetTop>iTarget)
            {
                speed=-10;
            }
            else
            {
                speed=10;
            }
            if(oDiv.offsetTop==iTarget)
            {
                clearInterval(timer);
            }
            else{
                oDiv.style.top=oDiv.offsetTop+speed+'px';
            }
        },10)
    }

    
};  
