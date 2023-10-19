var ul = document.querySelector('nav ul');
var amountNav = document.querySelector(".amount-nav");

function menuShow() {
    var iconHamburguer = document.getElementById('icon-hamburger');
    if (ul.classList.contains('open')){
        ul.classList.remove('open');
        iconHamburguer.setAttribute('name','menu-outline');
        
    }else{
        ul.classList.add('open');
        iconHamburguer.setAttribute('name','close-outline');
        
    }
}

  function toggleNumberInput(button) {
    var purchaseButton = button;
    var numberAmountDiv = purchaseButton.parentElement.nextElementSibling;
    purchaseButton.style.display = 'none';
    numberAmountDiv.style.display = 'block';
  }
  
  
  function increment() {
    var numberInput = event.target.parentNode.previousElementSibling;
    numberInput.value = parseInt(numberInput.value) + 1;
    updateAmountNav(numberInput.value);
  }
  
  function decrement() {
    var numberInput = event.target.parentNode.nextElementSibling;
    if (parseInt(numberInput.value) > 0) {
      numberInput.value = parseInt(numberInput.value) - 1;
      updateAmountNav(numberInput.value);
    }
  }

  function updateAmountNav(value) {
    amountNav.textContent = value;
  }


              // Inicializa o carrossel do Bootstrap
              var myCarousel = document.getElementById('carouselExampleDark');
              var carousel = new bootstrap.Carousel(myCarousel, {
                  interval: 5000 // Altere o intervalo de tempo desejado (em milissegundos)
              });



  
  
  
  