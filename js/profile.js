const form = document.querySelector(".signup form");
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
    e.preventDefault(); //Previne o envio do formulário 
}

function reloadPage() {
    setTimeout(function () {
        location.reload();
    }, 2000);
}

continueBtn.onclick = () => {
    //==== Fetch ====
    let formData = new FormData(form); //Pega os dados do formulário e cria um objeto FormData
    fetch("../server/profile.php", {
        method: "POST",
        body: formData,
    })
    .then((response) => {
        if (response.ok) {
            return response.text();
        }
    })
    .then((data) => {
        if (data.includes("sucesso")) {
            errorText.classList.add("sucess");
            errorText.textContent = data;
            errorText.style.display = "block";
            reloadPage();
        } else {
            //Exibe mensagem de erro
            errorText.classList.remove("sucess");
            errorText.textContent = data;
            errorText.style.display = "block";
        }
    })
    .catch((error) => {
        console.error("Error:", error);
    });
}