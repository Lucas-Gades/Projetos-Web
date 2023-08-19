const swiper = new Swiper('.swiper-container', {
    effect: 'coverflow', // Efeito de carrossel em 3D
    grabCursor: true, // Altera o cursor ao passar o mouse sobre o carrossel
    centeredSlides: true, // Centraliza os slides
    slidesPerView: 1.5, // Define a quantidade de slides exibidos por vez com base no tamanho da viewport
    loop: true, 
    coverflowEffect: {
      rotate: 0,
      stretch: 80,
      depth: 50,
      modifier: 1,
      slideShadows: true, // Desabilita as sombras dos slides
    },
    pagination: {
      el: '.swiper-pagination', // Elemento para exibir a paginação
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination', // Elemento para exibir a paginação
        clickable: true, // Torna as bolinhas clicáveis
      },
      

      
  });

  document.getElementById('occupation').addEventListener('change', function() {
    this.style.color = 'black'; // Limpar o estilo de cor ao selecionar uma opção
  });
  

  function getvalues(currentId) {
    let selectedField = document.getElementById(currentId);
    let fieldValue = selectedField.value;
    console.log(fieldValue);
    document.getElementById(currentId + "-view").textContent = fieldValue;
}


function selectValues() {
  var selectElement = document.getElementById("occupation");
  var selectedIndex = selectElement.selectedIndex;
  var selectedOption = selectElement.options[selectedIndex];
  var selectedValue = selectedOption.textContent;
  var spanElement = document.getElementById("occupation-view");
  spanElement.textContent = selectedValue;
}


let inputImg = document.querySelector('#user_image');
let showImage = document.querySelector('#show-image');

inputImg.addEventListener('change', function (event) {
    var tempUrl = URL.createObjectURL(event.target.files[0])
    showImage.setAttribute('src', tempUrl)

})
function preencherCampos(id, numero_pedido, nome_cliente, status) {
  document.getElementById('id_encomenda').value = id;
  document.getElementById('numero_pedido').value = numero_pedido;
  document.getElementById('nome_cliente').value = nome_cliente;
  document.getElementById('status').value = status;
}
function limparCampos() {
  document.getElementById('numero_pedido').value = '';
  document.getElementById('nome_cliente').value = '';
  document.getElementById('status').value = '';
}

