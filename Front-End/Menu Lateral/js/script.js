const botaoMenu = document.querySelector('.btn-menu');
const menuLateral = document.querySelector('.menu-lateral');
const cabecalhoMenu = document.querySelector('.cabecalho-menu');
const spansMenu = document.querySelectorAll('.lista-menu li a span');
const iconAbrir = document.querySelector('.btn-menu i.fa-bars');
const iconFechar = document.querySelector('.btn-menu i.fa-times');

botaoMenu.addEventListener('click', () => {
 menuLateral.classList.toggle('aberto');
 cabecalhoMenu.classList.toggle('mostrar');
 spansMenu.forEach( span => {
    span.classList.toggle('mostrar');
    span.style.marginLeft = '15px'
    
 }

 );
 iconAbrir.style.display = iconAbrir.style.display === 'none' ? 'inline' : 'none';
 iconFechar.style.display = iconFechar.style.display === 'none' ? 'inline' : 'none';
 document.body.classList.toggle('menu-aberto');
 document.nodeValue.classList.toggle('.menu-lateral');  
}

);