function calcularImc(){
    var nome = window.document.getElementById('nome').value
    var peso = Number(window.document.getElementById('peso').value)
    var altura = Number(window.document.getElementById('altura').value)
    var resultado = window.document.getElementById('resultado')
    
    var imc = peso / (altura * altura)
    
    resultado.innerHTML = `${nome} seu IMC é ${imc.toFixed(2)}`
    
}



