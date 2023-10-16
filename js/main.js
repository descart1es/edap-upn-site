//nav slide Toggle

$(document).ready(function(){
    $(".hamburger").click(function(){
        $(".nav-list").slideToggle()
    });
})

$(window).scroll(function(){
    var sc = $(this).scrollTop();
        if(sc > 50){
            $('header').addClass('sticky');
        }else{
            $('header').removeClass('sticky');
        }
    
})
/************* */

const hamburger= document.querySelector('.hamburger');

hamburger.addEventListener('click', ()=>{
    hamburger.classList.toggle('active')
})






const swiper = new Swiper('.review-slider', {
  spaceBetween: 20,
  loop:true,
  autoplay:{
    delay: 2500,
    desableOnInterraction: false,
  },
  breakpoints:{
      640:{
        slidesPerView: 1,
      },
      768:{
        slidesPerView: 2,
      },
      1024:{
        slidesPerView: 3,
      },
      2000:{
        slidesPerView: 3,
      }
  },
});
/**  Bouton  */

const btbn = document.querySelector(".bbtn");
btbn.addEventListener('click', () =>  {
       window.scrollTo(0, 1000)
          /* top: 0,
           left: 0,
           behavior: "smooth" 
            */
       

})


/******* Place aux cookies */


let popUp = document.getElementById("cookiePopup");
//Quand l'utilisateur click le bouton accepter
document.getElementById('acceptbtn').addEventListener("click", () =>{
// Ici on crée l'objet
let d = new Date();
d.setMinutes( 2 +  d.getMinutes());

document.cookie = "myCookieName=thisIsMyCookie; expires = " + d +";"
popUp.classList.add("hide");
popUp.classList.remove("show");

});
   const checkCookie = () =>{
    let input = document.cookie.split("=");

    if(input[0] == "myCookieName"){
        popUp.classList.add("hide");
        popUp.classList.remove("show");
    }
    else{
        //popUp.classList.add("show");
         popUp.classList.add('show');
         popUp.classList.remove('hide');
        //popUp.classList.remove("hide");
    }
 }
 //Ici on verifie si le cookie existe quand la page se charge
 window.onload = () => {
    setTimeout(()=>{
        checkCookie();
    }, 2000);
 }
 
/* window.onload = () =>{
    setTimeout(() => {
        checkCookie();
    },2000);*/

 

 
  


















