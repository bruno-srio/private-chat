

## Informações para teste:
Abaixo escrevi alguns dos emails introduzidos na base de dados, para facilitar o teste da aplicação:

 - johndoe@gmail.com
 - nakamoto@yahoo.com.br
 - schultz@gmail.com
 - killjoy@valorant.com

* **Todas as senhas foram definidas como:** teste

## Ideias pra um futuro desconhecido:

- Mensagens encriptadas
- Recuperação de conta ("Esqueceu a senha")
- Modificar a forma com que as mensagens são enviadas (websockets)
- Melhorar segurança contra SQL Injection
- Acelerar a pesquisa dos usuários (reduzir o intervalo talvez resolva)
- Admin Page
- Utilizar o padrão MVC(Por questões de organização, pode ser interessante)
- Remover imagens vinculadas ao usuário ao deletar a conta
- Botão que permite reverter alterações recentes ao perfil
- Status poderia ter uma opção amarela "ausente" como no Teams ao fechar o browser ou algo assim
- Foto de perfil expansiva (como do Whatsapp que mostra várias informações)
- Light/Dark mode
- Custom chat background
- Personalização de cores da aplicação pra cada usuário (só por diversão)
- Melhor interface responsiva
- Default profile picture (svg salvo em img/)


## Observações

#### converted/
A pasta "converted/" não tem nenhuma utilidade atualmente. 
Nela pretendo salvar imagens que inseridas por um URL visando fornecer mais de uma forma de adicionar ou atualizar a foto de perfil. 

#### profile_profileID
Esta é uma chave estrangeira que criei no banco de dados para uma futura página de administração. Através desta chave, o primeiro administrador do sistema terá permissão para autenticar outros administradores. No momento, essa ação precisa ser realizada manualmente no banco de dados.
