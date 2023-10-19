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
