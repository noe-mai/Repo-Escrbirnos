/* primero guardo en constantes los elementos HTML que necesito */
const burgerMenuBtn = document.querySelector('#burger-menu-toggler');
/* En este caso, al ser varios items y seleccionarlos todos, lo que se guarda
en la constante menuItems es una coleccion de nodos*/
const menuItems = document.querySelectorAll('.menu-item');


function navResponsive() {

    /* Agrego o quito una clase al body */
    burgerMenuBtn.addEventListener( 'click', function() {
        document.body.classList.toggle('mobile-menu-active');
    });


    /* Al clickear un item del menu mobile, este se cierra */
     menuItems.forEach(function(e) {
      
        e.addEventListener('click', function() {
        document.body.classList.remove('mobile-menu-active');
        })
    });

     /* agrego la clase active para dar estilos a los items del menu clickeados */
     for(let i = 0; i < menuItems.length; i++){
        menuItems[i].addEventListener('click', function () {
            let currentItem = document.querySelector('.active');
            currentItem.classList.toggle('active');
            this.classList.toggle('active');
        });
    }

}


navResponsive();