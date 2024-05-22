ACL Basic

Description
This is a web application built using the Laravel framework and Livewire component. The application manages users, roles, and abilities, allowing certain users to access different parts of the system based on their abilities associated with their roles. Additionally, roles have a hierarchy, ensuring that users with lower hierarchy cannot alter data of users with higher hierarchy.

Technologies Used
PHP
Laravel
Livewire
Database (MySQL, PostgreSQL, etc.)
Key Features
User Management: User registration, editing, deletion, and viewing.
Role Management: Definition of roles with hierarchy, assignment of abilities to roles.
Access Control Based on Abilities: Access to specific parts of the system based on abilities associated with user roles.
Role Hierarchy: Access restriction for users with lower hierarchy in relation to users with higher hierarchy.

Installation Requirements
1. Clone the repository.

2. Install dependencies using Composer, Node:
	-- composer install
	-- npm run build

3. Configure the .env file with the database information.
4. Run database migrations to create the necessary tables:
	-- php artisan migrate

5. Start the local server:
	-- php artisan serve

6. Access the application in the browser using the address provided by the local server.

Contributing
Contributions are welcome! Feel free to open an issue to report bugs, suggest improvements, or to submit a pull request.


Descrição
Esta é uma aplicação web construída utilizando o framework Laravel e o componente Livewire. A aplicação gerencia usuários, roles e habilidades, permitindo que determinados usuários tenham acesso a diferentes partes do sistema com base em suas habilidades associadas às suas roles. Além disso, as roles possuem uma hierarquia, garantindo que usuários com uma hierarquia inferior não possam alterar dados de usuários com hierarquia superior.

Tecnologias Utilizadas
PHP
Laravel
Livewire
Banco de Dados (MySQL, PostgreSQL, etc.)
Funcionalidades Principais
Gerenciamento de Usuários: Cadastro, edição, exclusão e visualização de usuários.
Gerenciamento de Roles: Definição de roles com hierarquia, atribuição de habilidades às roles.
Controle de Acesso Baseado em Habilidades: Acesso a partes específicas do sistema com base nas habilidades associadas às roles do usuário.
Hierarquia de Roles: Restrição de acesso para usuários com hierarquia inferior em relação a usuários com hierarquia superior.
Requisitos de Instalação
1. Clone o repositório.
2. Instale as dependências usando Composer, NPM:
-- composer install
-- npm run dev

3. Configure o arquivo .env com as informações do banco de dados.
4. Execute as migrações do banco de dados para criar as tabelas necessárias:

-- php artisan migrate

5. Inicie o servidor local:

-- php artisan serve

6. Acesse a aplicação no navegador usando o endereço fornecido pelo servidor local.

Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue para relatar bugs, sugestões de melhorias ou para enviar um pull request.
