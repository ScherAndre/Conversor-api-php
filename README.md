# Conversor de Real para Dólar

Projeto simples de conversão de moeda de Real (BRL) para Dólar (USD) utilizando a API oficial do Banco Central do Brasil.

## Como funciona

- O usuário informa um valor em reais no formulário.
- O PHP recebe esse valor via método POST.
- É feita uma requisição para a API PTAX do Banco Central buscando a cotação mais recente do dólar.
- O valor em reais é convertido para dólar com base na cotação obtida.
- O resultado é exibido na tela formatado em reais e dólares.

## Tecnologias utilizadas

- HTML
- CSS
- PHP
- API do Banco Central (PTAX)

## Estrutura do projeto

- index.html: Interface inicial com formulário para entrada do valor.
- index.php: Processa os dados, consome a API e exibe o resultado.
- style.css: Estilização da interface.

## Requisitos

- Servidor local com suporte a PHP (ex: XAMPP)
- Acesso à internet para consumir a API do Banco Central

## Como executar

1. Coloque os arquivos em um servidor local (htdocs no XAMPP).
2. Inicie o servidor Apache.
3. Acesse pelo navegador:

## API utilizada

- Banco Central do Brasil - PTAX
- Endpoint: Cotação do dólar por período