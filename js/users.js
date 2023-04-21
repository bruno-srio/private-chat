const searchBar = document.querySelector('.users .search input'); // Barra de pesquisa
const searchIcon = document.querySelector('.users .search button'); // Ícone de pesquisa
const usersList = document.querySelector('.users .users-list'); // Lista de usuários
const profile = document.querySelector('.users header button'); // "Setinha pra baixo"
const hiddenOp = document.querySelector('.hidden-op'); // Botões extras do perfil
const userHeader = document.querySelector('.users header');
const debounceTimeout = 500; // ms




function viewProfile() {
  profile.classList.toggle('active');
  if (profile.classList.contains('active')) {
    hiddenOp.style.display = "block";
    userHeader.style.borderBottom = "none";
  } else {
    hiddenOp.style.display = "none";
    userHeader.style.borderBottom = "1px solid #e6e6e6";
  }
};

// Alterna a classe "ativo" da barra de pesquisa e do ícone de pesquisa
function toggleSearchBar() {
  searchBar.classList.toggle('active');
  searchBar.focus();
  searchIcon.classList.toggle('active');
}


// Cria uma função debounce para reduzir requests ao servidor
function debounce(callback, timeout) {
  let timer;
  return function (...args) {
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback(...args);
    }, timeout);
  };
}

// Pesquisa usuários no servidor
function searchUsers() {
  // Obtém o termo de pesquisa digitado
  const searchTerm = searchBar.value;

  if (searchTerm) {
    // Mantém a barra de pesquisa ativa enquanto há algo escrito
    searchBar.classList.add('active');
  } else {
    searchBar.classList.remove('active');
    searchIcon.classList.remove('active');
  }

  // Envia o termo de pesquisa para o servidor
  fetch('../server/search.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `searchTerm=${searchTerm}`,
  })
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      // Atualiza a lista de usuários com os resultados da pesquisa
      usersList.innerHTML = data;
    })
    .catch(function (error) {
      // Trata o erro
      console.error(error);
    });
}

// Atualiza a lista de usuários
function updateActiveUsers() {
  fetch('../server/users.php')
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      // Atualiza a lista de usuários, a menos que a barra de pesquisa esteja ativa
      if (!searchBar.classList.contains('active')) {
        usersList.innerHTML = data;
      }
    })
    .catch(function (error) {
      // Trata o erro
      console.error(error);
    });
}

searchIcon.addEventListener('click', toggleSearchBar);
searchBar.addEventListener('keyup', debounce(searchUsers, debounceTimeout));
profile.addEventListener('click', viewProfile);

// Atualiza a lista de usuários a cada 500ms
setInterval(updateActiveUsers, 500);