 
 (function (){

    var slide =function (code){
	var me=this;
        this.code=code;
        this.curente=0;
        this.leftButtom=$("."+this.code+" .slideViewLeft");
        this.rightButtom=$("."+this.code+" .slideViewRight");
        this.listItem=$("."+this.code+" .slideViewListItem");
        this.items=$("."+this.code+" .itemSlideView ").get().reverse();
        this.itemsListChoise=$("."+this.code+" .navSelectItem .selectItemNav");
        this.nbElemment=this.itemsListChoise.length;
        this.animate=0;
         this.activeAnimation=function (){
        this.animate=window.setInterval(function (){
	if(!document.hidden){

	if(me.curente==0){
	me.changeItem(me.curente,me.curente+1);	
	}else if (me.curente<me.nbElemment-1){
	me.changeItem(me.curente,me.curente+1);		
	}else{
	me.changeItem(me.curente,0);	
	}
	
		
	
}
},6000);
}
this.stopAnimation=function (){
	window.clearInterval(this.animate);
	this.animate=false;
}
this.activeAnimation();

        this.itemsListChoise.each (function (index,el){
	
	$(el).click(function (e){
		me.stopAnimation();
		me.active();
	me.changeItem(me.curente,index);	
	});
});
        this.totalItem=this.items.length;
        $(this.itemsListChoise[this.curente]).addClass("active");
        this.active=function (){
         for (var o=0;o<this.itemsListChoise.length;o++){
             $(this.itemsListChoise[o]).removeClass("active");
         }
         $(this.itemsListChoise[this.curente]).addClass("active");
        }
        
        this.funcLeft=function (e){
	        me.stopAnimation();
            e.preventDefault();
            if (this.curente==0){
         	   return;
            }
            
          me.changeItem(me.curente,me.curente-1);	
            
        }
        this.funcRight=function (e){
	        me.stopAnimation();
            e.preventDefault();
            if( this.curente==this.totalItem-1  ){
          	   return;
             }
      
  
         me.changeItem(me.curente,me.curente+1);	
            
        }

        this.funcLeft= this.funcLeft.bind(this);
        this.funcRight= this.funcRight.bind(this);
        $(this.leftButtom).on("click", this.funcLeft);
        $(this.rightButtom).on("click",this.funcRight);

 this.changeItem=function (current,NexteItem){
	$(this.items[current]).fadeOut( "1ms", function() {
  

  });
  $(me.items[NexteItem]).fadeIn("1ms",function() {
	me.curente=NexteItem;
	if(me.animate==false){
			me.activeAnimation();
	}

	me.active();
});
}
     
    }
    var codegenereView=[];
    function getRandomText(length) {
        var charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".match(/./g);
        var text = "";
        for (var i = 0; i < length; i++) text += charset[Math.floor(Math.random() * charset.length)];
        return text;
      }
$(".SlideView").each(function (i,e){
    var code=getRandomText(7);
if (!codegenereView.find(function (e){
if(code==e){
    return true;
}
})){
$(this).addClass(code); 
new slide(code);

}
});

})();