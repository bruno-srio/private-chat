const form = document.querySelector(".typing-area"),
    messageInput = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button");
chatBox = document.querySelector(".chat-box");

let userID = new URLSearchParams(window.location.search).get("userID");

// Impede o envio do formulário
form.onsubmit = function (e) {
    e.preventDefault();
};

// Ao clicar no botão de enviar mensagem:
function onSentBtnClick() {
    let formData = new FormData(form); //Guarda os dados do formulário e cria um objeto FormData
    fetch("../server/insertChat.php", {
        method: "POST",
        body: formData,
    })
        .then(function (response) {
            if (response.ok) {
                messageInput.value = ""; //Limpa a mensagem digitada quando enviada com sucesso
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
    scrollToBottom();
}

//Permite o usuário navegar pelas mensagens
function onChatBoxMouseEnter() {
    chatBox.classList.add("active");
}

function onChatBoxMouseLeave() {
    chatBox.classList.remove("active");
}


function getChat() {
    let formData = new FormData(form);
    formData.append("userID", userID);
    fetch("../server/getChat.php", {
        method: "POST",
        body: formData,
    })
        .then(function (response) {
            if (response.ok) {
                return response.text();
            }
        })
        .then(function (data) {
            chatBox.innerHTML = data;
            if (!chatBox.classList.contains("active")) {
                //Faz o scroll automático se o mouse não está no chat
                scrollToBottom();
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}

// event listeners
sendBtn.addEventListener("click", onSentBtnClick);
chatBox.addEventListener("mouseenter", onChatBoxMouseEnter);
chatBox.addEventListener("mouseleave", onChatBoxMouseLeave);

//setInterval
setInterval(getChat, 500);