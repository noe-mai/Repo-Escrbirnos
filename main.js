/* Responsive con JS */

const burgerMenuBtn = document.querySelector('#burger-menu-toggler');


const menuItems = document.querySelectorAll('.menu-item');


function navResponsive() {

  
    burgerMenuBtn.addEventListener( 'click', function() {
        document.body.classList.toggle('mobile-menu-active');
    });


 
     menuItems.forEach(function(e) {
      
        e.addEventListener('click', function() {
        document.body.classList.remove('mobile-menu-active');
        })
    });

     for(let i = 0; i < menuItems.length; i++){
        menuItems[i].addEventListener('click', function () {
            let currentItem = document.querySelector('.active');
            currentItem.classList.toggle('active');
            this.classList.toggle('active');
        });
    }

}


navResponsive();