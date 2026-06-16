# Jogo da Forca - Versão PHP (Server-Side)

Este repositório contém a versão em PHP do Jogo da Forca, executada inteiramente no lado do servidor. Este projeto faz parte de um estudo comparativo entre renderização Client-Side (JS) e Server-Side (PHP).

## 🆚 Comparativo de Abordagens (PHP vs JS)

A principal diferença desta versão é que o navegador do usuário é "cego". Ele não sabe qual é a palavra secreta e não processa a lógica de acerto ou erro.

| Característica | Jogo da Forca em PHP | Jogo da Forca em JS |
| :--- | :--- | :--- |
| **Ambiente de Execução** | Servidor (Back-end) | Navegador do Usuário (Front-end) |
| **Armazenamento de Estado** | Sessões (`$_SESSION`) | Variáveis na memória do navegador |
| **Segurança da Palavra** | **Alta**: O código fonte PHP não vai para o navegador. O usuário só recebe o HTML processado. | **Baixa**: A palavra secreta pode ser lida no "Inspecionar Elemento". |
| **Dinâmica de Tela** | Requer requisições (POST) para enviar a letra, gerando um novo HTML a cada jogada. | Manipulação do DOM instantânea, sem recarregar a página. |

## 📦 Entregas de Valor (Versionamento Semântico)

- **v0.1.0**: Estrutura base (HTML/CSS adaptado para formulários POST) e documentação.

- **v1.0.0**: Release Principal (MVP). Lógica de jogo totalmente funcional em PHP. Utilização de `$_SESSION` para manter o estado (vidas, letras tentadas, palavra sorteada) de forma segura no servidor entre requisições POST. Implementado controle de fluxo e formulários dinâmicos.

