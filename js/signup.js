const form = document.querySelector(".signup form"); // Formulário de cadastro
continueBtn = form.querySelector(".button input"); // Botão de continuar
errorText = form.querySelector(".error-txt"); // Mensagens do servidor

form.onsubmit = (e) => {
    e.preventDefault(); // Previne o envio do formulário 
}

continueBtn.onclick = async () => {
    // Envia os dados do formulário para o servidor
    fetch("server/signup.php", {
        method: "POST",
        body: new FormData(form)
    })
    .then(response => {
        if(response.ok){
            return response.text()
        }
    })
    .then(data => {
        if (data.includes("sucesso")) {
            location.href = "subpages/users.php"; // Redireciona para a página de usuários após o registro
        } else {
            // Exibe mensagem de erro
            errorText.textContent = data;
            errorText.style.display = "block";
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
