# 📧 App Mail Send

Um sistema moderno e intuitivo para envio de e-mails, desenvolvido em PHP. O projeto utiliza **PHPMailer** para o backend e **JavaScript (Fetch API)** para uma experiência de usuário fluida (SPA feeling), sem recarregamento de página, com feedback visual via **SweetAlert2**.

![Status](https://img.shields.io/badge/Status-Concluído-success)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue)
![License](https://img.shields.io/badge/License-MIT-green)

## 🚀 Tecnologias Utilizadas

* **Backend:** PHP 7+ (Orientado a Objetos)
* **Biblioteca de E-mail:** PHPMailer 6.x/7.x
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Interatividade:** JavaScript (Fetch API - AJAX)
* **Alertas:** SweetAlert2
* **Servidor Local:** Apache (via XAMPP)

## 📋 Pré-requisitos

Para rodar este projeto localmente, você precisará de:

1.  **XAMPP** instalado (ou qualquer servidor Apache com PHP).
2.  Uma conta de e-mail (Gmail recomendado) com "Senha de App" configurada.

## 🔧 Instalação e Configuração (XAMPP)

Siga os passos abaixo para configurar o ambiente de desenvolvimento:

### 1. Clone ou Baixe o Repositório
Vá até a pasta `htdocs` do seu XAMPP (geralmente em `C:\xampp\htdocs`) e coloque a pasta do projeto lá.
2. Estrutura de Pastas
Certifique-se de que a biblioteca PHPMailer esteja na pasta correta conforme o código:

/app-mail-send
  ├── /bibliotecas
  │    └── /PHPMailer-7.0.0
  ├── /imgs
  ├── index.php
  ├── processa_envio.php
  └── README.md
  3. Configuração do Servidor SMTP
Abra o arquivo processa_envio.php e edite as credenciais do Gmail.

⚠️ IMPORTANTE: Por segurança, nunca suba suas senhas reais para o GitHub. Recomenda-se usar Variáveis de Ambiente em produção.

PHP

// processa_envio.php

$mail->Host       = 'smtp.gmail.com';
$mail->Username   = 'seu-email@gmail.com';
$mail->Password   = 'sua-senha-de-app-aqui'; // Não use a senha de login do Google!
$mail->Port       = 465;
Nota: Para o Gmail, você deve ativar a verificação em duas etapas na sua conta Google e gerar uma Senha de App (App Password). Senhas normais não funcionam mais para SMTP externo.

▶️ Como Rodar
Abra o XAMPP Control Panel.

Inicie o módulo Apache (clique em Start).

Abra seu navegador e acesse: http://localhost/nome-da-sua-pasta

Preencha o formulário e clique em enviar. Você verá o processo ocorrer sem a página recarregar!

🛠️ Melhorias Implementadas (Log de Alterações)
[x] Atualização da interface para Bootstrap 5.

[x] Implementação de AJAX/Fetch API para envio assíncrono.

[x] Substituição de feedbacks de texto simples por SweetAlert2.

[x] Refatoração do PHP para retornar respostas em JSON.
📄 Licença
Este projeto está sob a licença MIT. Sinta-se à vontade para contribuir!

Desenvolvido por [Carlos Anderson]