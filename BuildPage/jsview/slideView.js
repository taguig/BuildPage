 
 (function (){

    var slide =function (code){
	var me=this;
        this.code=code;
        this.curente=0;
        this.leftButtom=$("."+this.code+" .slideViewLeft");
        this.rightButtom=$("."+this.code+" .slideViewRight");
        this.listItem=$("."+this.code+" .slideViewListItem");
        this.count=$(this.listItem).find("div").length;
        $("."+this.code+" .slideViewListItem").width(100 *this.count +"%");
        this.items=$("."+this.code+" .itemSlideView");
        this.itemsListChoise=$("."+this.code+" .navSelectItem .selectItemNav");
        this.nbElemment=this.itemsListChoise.length;
        this.animate=0;
         this.activeAnimation=function (){
        this.animate=window.setInterval(function (){
	if(!document.hidden){
	if (me.curente==me.nbElemment-1){
		me.curente=0;
	}else {
		me.curente++;
	}
		
		me.active();
	 $(me.listItem).animate({left:"-"+(100*me.curente)+'%'},300);
}
},3000);
}
this.stopAnimation=function (){
	window.clearInterval(this.animate);
}
this.activeAnimation();

        this.itemsListChoise.each (function (index,el){
	
	$(el).click(function (e){
		me.stopAnimation();
		me.curente=index;
		me.active();
	 $(me.listItem).animate({left:"-"+(100*me.curente)+'%'},{duration :300,complete:function (){me.activeAnimation()}});	
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
            this.curente--;
            this.active();
            $(this.listItem).animate({left:"-"+(100*this.curente)+'%'},{duration :300,complete:function (){me.activeAnimation()}});
            
        }
        this.funcRight=function (e){
	        me.stopAnimation();
            e.preventDefault();
            if( this.curente==this.totalItem-1  ){
          	   return;
             }
             this.curente++;
             this.active();
  
             $(this.listItem).animate({left:"-"+(100*this.curente)+'%'},{duration :300,complete:function (){me.activeAnimation()}});
            
        }

        this.funcLeft= this.funcLeft.bind(this);
        this.funcRight= this.funcRight.bind(this);
        $(this.leftButtom).on("click", this.funcLeft);
        $(this.rightButtom).on("click",this.funcRight);
     
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