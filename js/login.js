const form = document.querySelector(".login form"); // Formulário de login
const continueBtn = form.querySelector(".button input"); // Botão de continuar
const errorText = form.querySelector(".error-txt"); // Mensagens do servidor

form.onsubmit = (e) => {
    e.preventDefault(); //Previne o envio do formulário 
}

continueBtn.onclick = () => {
    //==== Fetch ====
    let formData = new FormData(form); //Guarda os dados do formulário e cria um objeto FormData
    fetch("../server/login.php", {
        method: "POST",
        body: formData,
    })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
        })
        .then(data => {
            if (data.includes("sucesso")) {
                location.href = "../subpages/users.php"; //Redireciona para a página de usuários após o login	
            } else {
                //Exibe mensagem de erro
                errorText.textContent = data;
                errorText.style.display = "block";
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
}