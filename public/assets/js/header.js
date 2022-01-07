window.onload=function(){
   
}
function givehigh(elem){
    var images=document.getElementsByName("carousel-img");
    var abc = document.getElementById("img-high").src;
    var img_src = images[elem].src;
    document.getElementById("img-high").src = img_src;
    console.log(img_src);
}
