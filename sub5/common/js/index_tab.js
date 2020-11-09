window.onload=function(){
    
    let list=document.getElementsByClassName('contlist');   
    let tabs1=document.getElementById('tabs1');
    let tabs2=document.getElementById('tabs2');

    
    let purl=window.location;
    tmp=String(purl).split('?');
    
     if(tmp[1]!=undefined){
        
        tmp2=tmp[1].split('=');
         
        if(tmp2[1]==1){
            list[0].style.display='block';
            
        }else if(tmp2[1]==2){
            list[0].style.display='none';
            list[1].style.display='block';
            tabs1.classList.remove('on');
            tabs2.classList.add('on');
        }
    }
}