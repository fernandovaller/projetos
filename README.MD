# Projetos

Sistema para controle de tarefas dos projetos.		

![MyLinks](https://raw.githubusercontent.com/fernandovaller/projetos/master/screenshot.png)

![MyLinks](https://raw.githubusercontent.com/fernandovaller/projetos/master/screenshot2.png)

![MyLinks](https://raw.githubusercontent.com/fernandovaller/projetos/master/screenshot3.png)

## Instalação

É preciso criar o arquivo `.env` a partir do exemplo `.env-default`, na raiz do projeto com as informações para conexão ao banco de dados MySQL.

Após crie o banco de dados de acordo com a estrutura fornecida no diretório `app/database/`

Execute o composer na raiz do projeto para instalar as dependências necessárias:

	$ compose install

Criar o usuário para o primeiro acesso.	

	INSERT INTO `usuarios` (`id`, `nome`, `email`, `login`, `senha`, `data_acesso`, `status`) VALUES (1, 'Demonstração', 'demo@email.com', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '2019-03-27 08:40:58', '1');

Faça login com o usuário criado:

	Usuário: demo
	Senha: demo

Para execultar rode:

	$ php -S localhost:8080

## Contribuindo

Esteja a vontade para criar melhorias e novas funcionalidades. Espero que seja útil.

## License
[MIT](https://choosealicense.com/licenses/mit/)