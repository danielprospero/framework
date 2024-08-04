-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: 108.179.253.88    Database: dani3764_nucleoadvance
-- ------------------------------------------------------
-- Server version	5.7.23-23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_categoria_id` int(11) DEFAULT '0',
  `visitas` int(11) DEFAULT NULL,
  `data_ultima_visita` timestamp NULL DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `titulo` (`categoria`),
  KEY `categorias_ibfk_1` (`status_categoria_id`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`status_categoria_id`) REFERENCES `status_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (7,'PHP','php',1,885,'2024-08-04 04:37:20','2023-09-12 18:44:25','2023-09-13 15:03:18'),(8,'Estilo de  Vida','estilo-de-vida',1,855,'2024-08-01 20:23:19','2023-09-12 18:55:34','2023-10-18 19:55:45'),(9,'LGPD','lgpd',1,834,'2024-07-31 19:26:35','2023-10-12 14:47:55','2023-10-12 14:48:33'),(10,'Asterisk','asterisk',1,998,'2024-07-30 10:21:38','2023-10-18 19:24:57',NULL),(11,'Linux','linux',1,838,'2024-08-03 22:05:40','2023-10-18 19:28:21',NULL),(12,'Marketing Digital','marketing-digital',1,869,'2024-08-02 21:03:45','2023-10-22 21:51:11',NULL),(13,'Banco de Dados','banco-de-dados',1,795,'2024-07-30 10:21:38','2023-10-26 00:03:31',NULL);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS `contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `contatos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatos`
--

LOCK TABLES `contatos` WRITE;
/*!40000 ALTER TABLE `contatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postagens`
--

DROP TABLE IF EXISTS `postagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `titulo` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conteudo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitas` int(11) DEFAULT NULL,
  `data_ultima_visita` timestamp NULL DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `titulo` (`titulo`),
  KEY `slug` (`slug`),
  KEY `created` (`created`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagens`
--

LOCK TABLES `postagens` WRITE;
/*!40000 ALTER TABLE `postagens` DISABLE KEYS */;
INSERT INTO `postagens` VALUES (6,1,11,'Configurar o endereço IP estático no Ubuntu Server 20.04','Como definir o endereço IP estático no servidor Ubuntu usando o Netplan','<h2>Como definir o endereço IP estático no servidor Ubuntu usando o Netplan</h2><p data-sourcepos=\"3:1-3:107\" dir=\"auto\">Para o servidor Ubuntu, o arquivo YAML é 00-installer-config.yaml e essas são as configurações padrão.</p><p data-sourcepos=\"3:1-3:107\" dir=\"auto\"><img src=\"/////////uploads/image.png\" data-filename=\"image.png\" style=\"width: 433px;\"></p><p data-sourcepos=\"7:1-7:50\" dir=\"auto\">Passo 1: Acesse o arquivo 00-installer-config.yaml com o seu editor preferido eu vou usar o vim.</p><table class=\"table table-bordered\"><tbody><tr><td>$ sudo vim /etc/netplan/00-installer-config.yaml&nbsp;</td></tr></tbody></table><p data-sourcepos=\"7:1-7:50\" dir=\"auto\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Passo 2:</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;Para configurar um IP estático, copie e cole a configuração abaixo. Esteja atento ao espaçamento no arquivo YAML.</span></p><pre><pre># This is the network config written by \'subiquity\'  <br>network:<br>  version: 2<br>  ethernets:<br>    ens18:<br>      dhcp4: false<br>      addresses: [192.168.0.3/24]<br>      gateway4: 192.168.0.1<br>      nameservers:<br>        addresses: [8.8.8.8, 8.8.4.4]</pre></pre><pre class=\"code highlight js-syntax-highlight plaintext white\" lang=\"plaintext\" v-pre=\"true\">Certifique-se de trocar os ips para os ips da sua rede. </pre><p data-sourcepos=\"24:1-24:95\" dir=\"auto\"><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Passo 3:</span><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">&nbsp;</span>&nbsp;Em seguida, salve o arquivo e execute o comando netplan abaixo para salvar as alterações.</p><table class=\"table table-bordered\"><tbody><tr><td>$ netplan apply</td></tr></tbody></table><pre class=\"code highlight js-syntax-highlight plaintext white\" lang=\"plaintext\" v-pre=\"true\"><br></pre>','uploads/1697938660rede.jpg','meu-primeira-prostagem',163,'2024-07-30 10:21:40','2023-09-14 19:51:38','2023-10-21 22:53:04'),(8,1,11,'Como alterar o nome do host no Ubuntu server 20.04','O hostname é o nome do seu servidor e é usado para identificá-lo na rede.','<div>Para mudar o hostname em um servidor Ubuntu 20.04, siga os passos abaixo. O hostname é o nome do seu servidor e é usado para identificá-lo na rede. Lembre-se de que você deve ter privilégios de superusuário (root) ou usar o comando sudo para executar esses comandos.</div><div><br></div><div>Passo 1: Verifique o hostname atual</div><div><br></div><div>Você pode verificar o hostname atual usando o comando hostname:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ hostname</td></tr></tbody></table><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Passo 2: Altere o hostname temporariamente</span><div>Para alterar o hostname temporariamente (até o próximo reinício), você pode usar o comando hostnamectl. Substitua novo-hostname pelo nome que você deseja usar:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ sudo hostnamectl set-hostname novo-hostname</td></tr></tbody></table><div><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Passo 3: Verifique a alteração temporária</span><br></div><div>Você pode verificar se a alteração temporária funcionou usando o comando hostname novamente:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ hostname</td></tr></tbody></table><div><br></div><div>Passo 4: Edite o arquivo /etc/hostname</div><div>Para fazer a alteração permanente do hostname, você precisa editar o arquivo /etc/hostname. Use um editor de texto, como o nano ou o vi, para fazer isso. Por exemplo, usando o nano:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ sudo nano /etc/hostname<br></td></tr></tbody></table><div><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Isso abrirá o arquivo /etc/hostname no editor de texto. Substitua o nome atual pelo novo nome do hostname e, em seguida, salve o arquivo.</span><br></div><div><br></div><div>Passo 5: Edite o arquivo /etc/hosts</div><div>Você também precisa editar o arquivo /etc/hosts para refletir a alteração do hostname. Use o mesmo editor de texto para editar este arquivo:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ sudo nano /etc/hosts<br></td></tr></tbody></table><div>Você verá uma linha que se parece com esta:</div><div><br></div><div>127.0.1.1   hostname-anterior</div><div><br></div><div>Substitua hostname-anterior pelo novo nome do hostname que você definiu no Passo 4.</div><div><br></div><div>Passo 6: Reinicie o servidor</div><div><br></div><div>Para aplicar as alterações, você precisa reiniciar o servidor:</div><div><br></div><table class=\"table table-bordered\"><tbody><tr><td>$ sudo reboot</td></tr></tbody></table><div>Após reiniciar, o novo hostname estará em vigor e será permanente.</div><div><br></div><div>Certifique-se de escolher um hostname descritivo e que siga as convenções de nomenclatura apropriadas para o seu ambiente.</div>','uploads/1697937567ubuntu_sudo.jpg','meu-primeira-prostagem1',91,'2024-07-30 10:21:40','2023-09-14 20:48:21','2023-10-21 22:26:12'),(9,1,11,'Como instalar o Ubuntu server 22.04.03 LTS',' Tutorial passo a passo para instalar o Ubuntu Server 22.04.03 LTS','<p><b>Passo 1: Preparação</b></p><p>1. Baixe a imagem ISO mais recente do Ubuntu Server no site oficial da Canonical: </p><p>https://ubuntu.com/download/server</p><p>2. Grave a imagem ISO em um pendrive USB ou crie um DVD de inicialização usando um software de gravação de sua escolha. Recomendo o uso do&nbsp;<a href=\"https://rufus.ie/pt_BR/\" target=\"_blank\" style=\"color: rgb(35, 82, 124); text-decoration: underline; --bs-link-color-rgb: var(--bs-link-hover-color-rgb); background-color: rgb(255, 255, 255); font-family: sans-serif; font-weight: 400; outline: 0px;\">Rufus</a>&nbsp;para criar um pendrive inicializável.</p><p>3. Insira o pendrive USB ou o DVD de inicialização no computador onde você deseja instalar o Ubuntu Server.</p><p><b>Passo 2: Inicialização e Instalação</b></p><p>1. Ligue o computador e acesse o menu de inicialização. Isso geralmente é feito pressionando uma tecla específica (como F12, F2, ou Delete) durante o processo de inicialização, dependendo do fabricante da sua placa-mãe. Selecione a unidade USB ou DVD como dispositivo de inicialização.</p><p>2. Você verá a tela de boas-vindas do Ubuntu Server. Escolha a opção \"Install Ubuntu Server\" (Instalar o Ubuntu Server) e pressione Enter.</p><p>3. Escolha o idioma que você deseja usar durante a instalação e pressione Enter.</p><p>4. Selecione sua localização e fuso horário.</p><p>5. Configure o layout do teclado.</p><p>6. Escolha se deseja configurar o servidor em uma rede com fio ou sem fio (se aplicável). Insira as informações de rede conforme necessário.</p><p>7. O instalador solicitará um nome de host para o seu servidor. Digite um nome descritivo e pressione Enter.</p><p>8. Escolha se deseja configurar um proxy de rede (geralmente, você pode deixar isso em branco).</p><p>9. O instalador perguntará se você deseja instalar atualizações automaticamente. É recomendável escolher \"Install security updates automatically\" (Instalar atualizações de segurança automaticamente) para manter o sistema seguro.</p><p>10. Escolha o tipo de instalação. Você pode optar por instalar o sistema base e serviços adicionais, como um servidor de impressão, servidor OpenSSH, servidor de banco de dados e outros. Escolha de acordo com suas necessidades. Para um servidor web típico, você pode selecionar \"OpenSSH server\" e \"Basic Ubuntu server\" e, se necessário, adicionar serviços adicionais posteriormente.</p><p>11. Selecione o disco onde deseja instalar o Ubuntu Server. Você pode escolher entre apagar o disco ou criar partições manualmente, dependendo das suas necessidades. Para a maioria dos casos, a opção \"Erase disk and install Ubuntu\" (Apagar o disco e instalar o Ubuntu) funcionará bem.</p><p>12. Confirme a ação e aguarde a instalação.</p><p><b>Passo 3:</b> <b>Configuração Pós-Instalação</b></p><p>1. Defina a senha do superusuário (root) do sistema.</p><p>2. Crie uma conta de usuário, definindo um nome de usuário e senha.</p><p>3. O instalador solicitará que você habilite as atualizações automáticas de segurança. É altamente recomendável ativar essa opção para manter seu sistema atualizado.</p><p>4. Escolha se deseja participar ou não do programa de aprimoramento de estatísticas de uso. Isso é opcional.</p><p>5. A instalação estará concluída. Remova o pendrive USB ou o DVD e pressione Enter para reiniciar o servidor.</p><p><b>Passo 4: Acesso ao Servidor</b></p><p>1. Após a reinicialização, você pode acessar o Ubuntu Server usando o nome de usuário e senha que você configurou durante a instalação.</p><p>2. Você pode gerenciar seu servidor usando a linha de comando ou instalar interfaces gráficas, dependendo das suas necessidades.</p><p>Agora você tem o Ubuntu Server instalado e pode configurá-lo de acordo com as necessidades do seu projeto ou servidor. Certifique-se de manter o sistema atualizado e seguro através da aplicação regular de atualizações e configuração de firewall, se necessário.</p>','uploads/1698021278ubuntu-unsplash.jpg','ubuntu-22-04',185,'2024-07-30 10:21:39','2023-09-15 19:40:04','2023-10-22 21:34:39'),(10,1,7,'Tutorial passo a passo sobre como baixar e instalar o XAMPP','Tutorial passo a passo sobre como baixar e instalar o XAMPP, um pacote que inclui Apache, MySQL, PHP e outras ferramentas','<p>Tutorial passo a passo sobre como baixar e instalar o XAMPP, um pacote que inclui Apache, MySQL, PHP e outras ferramentas, para configurar um servidor web local no Windows. Isso permitirá que você desenvolva e teste seus sites e aplicativos web em seu ambiente de desenvolvimento local. Siga as etapas abaixo:</p><h3><b>Passo 1: Baixando o XAMPP</b></h3><p>1. Acesse o site oficial do XAMPP: <a href=\"https://www.apachefriends.org/index.html\" target=\"_blank\">https://www.apachefriends.org/index.html</a></p><p>2. Na página inicial, você encontrará links para diferentes versões do XAMPP, dependendo do seu sistema operacional. Clique no link \"XAMPP for Windows\" para baixar a versão compatível com o Windows.</p><p>3. O download deve começar automaticamente. Aguarde até que o arquivo seja baixado.</p><h3><b>Passo 2: Instalando o XAMPP</b></h3><p>1. Após o download ser concluído, execute o arquivo de instalação que você baixou. Você pode ser solicitado a fornecer permissões de administrador.</p><p>2. O instalador do XAMPP será iniciado. Clique em \"Next\" (Próximo) para continuar.</p><p>3. Você verá uma lista de componentes que podem ser instalados. Geralmente, todos os componentes padrão são suficientes para a maioria dos casos de uso. Você pode selecionar ou desmarcar componentes conforme necessário. Clique em \"Next\" (Próximo) para continuar.</p><p>4. Escolha o diretório onde deseja instalar o XAMPP. O diretório padrão (geralmente C:\\xampp) funciona bem, mas você pode escolher um diretório diferente se desejar. Clique em \"Next\" (Próximo).</p><p>5. Na próxima tela, você será solicitado a instalar add-ons opcionais. Você pode desmarcar essas opções se não precisar delas. Clique em \"Next\" (Próximo).</p><p>6. O instalador agora estará pronto para começar a instalação. Clique em \"Next\" (Próximo) para iniciar o processo.</p><p>7. Aguarde até que o XAMPP seja instalado em seu sistema.</p><p>8. Após a instalação ser concluída, você verá uma tela de conclusão. Marque a caixa \"Do you want to start the Control Panel now?\" (Você deseja iniciar o Painel de Controle agora?) e clique em \"Finish\" (Concluir).</p><h3><b>Passo 3: Inicializando e Configurando o XAMPP</b></h3><p>1. O Painel de Controle do XAMPP será aberto. A partir dele, você pode iniciar e parar os serviços necessários, como Apache e MySQL.</p><p>2. Para iniciar o Apache e MySQL, clique nos botões \"Start\" (Iniciar) ao lado de seus nomes.</p><h3><b>Passo 4: Verificando a Instalação</b></h3><p>1. Abra um navegador da web e acesse <a href=\"http://localhost/\" target=\"_blank\">http://localhost/</a>. Você deverá ver a página de boas-vindas do XAMPP, indicando que o Apache está funcionando corretamente.</p><p>2. Para acessar o painel de controle do phpMyAdmin (para gerenciar seu banco de dados MySQL), acesse <a href=\"http://localhost/phpmyadmin/\" target=\"_blank\">http://localhost/phpmyadmin/</a>.</p><p>Agora você tem o XAMPP instalado e configurado em seu sistema Windows, permitindo que você desenvolva e teste seus projetos web localmente. Certifique-se de parar os serviços Apache e MySQL quando não estiver usando o XAMPP para economizar recursos do sistema.</p>','uploads/1698022071xampp.jpg','ubuntu-22-04-teste-1',247,'2024-08-03 20:17:28','2023-09-28 18:27:29','2023-10-22 21:47:51'),(12,1,9,'Política de Privacidade e Uso de Cookies','Política de privacidade e uso de cookies do  blog','<p>teste</p>\r\n<ol>\r\n<li><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Introdu&ccedil;&atilde;o</span></li>\r\n</ol>\r\n<p>Bem-vindo ao N&uacute;cleo Advance. Valorizamos sua privacidade e estamos comprometidos em proteger suas informa&ccedil;&otilde;es pessoais. Esta pol&iacute;tica explica como coletamos, usamos e protegemos suas informa&ccedil;&otilde;es. Ao acessar ou usar nosso blog, voc&ecirc; concorda com os termos desta pol&iacute;tica. Se voc&ecirc; n&atilde;o concorda com esta pol&iacute;tica, por favor, n&atilde;o use nosso blog.</p>\r\n<p>2. Informa&ccedil;&otilde;es que Coletamos</p>\r\n<p>2.1. Informa&ccedil;&otilde;es de Acesso: Quando voc&ecirc; visita nosso blog, coletamos informa&ccedil;&otilde;es padr&atilde;o de acesso &agrave; web, como o endere&ccedil;o IP, tipo de navegador e p&aacute;ginas acessadas. Essas informa&ccedil;&otilde;es nos ajudam a entender como os visitantes interagem com nosso blog.</p>\r\n<p>2.2. Coment&aacute;rios: Se voc&ecirc; optar por deixar um coment&aacute;rio em nosso blog, coletaremos seu nome, endere&ccedil;o de e-mail e o conte&uacute;do do coment&aacute;rio. Essas informa&ccedil;&otilde;es s&atilde;o usadas para exibir seu coment&aacute;rio e responder, se necess&aacute;rio.</p>\r\n<p>3. Uso de Cookies</p>\r\n<p>3.1. O que s&atilde;o Cookies: Cookies s&atilde;o pequenos arquivos de dados que s&atilde;o armazenados no seu navegador quando voc&ecirc; visita nosso blog. Eles s&atilde;o usados para melhorar a experi&ecirc;ncia do usu&aacute;rio, lembrar prefer&ecirc;ncias e rastrear o desempenho do site.</p>\r\n<p>3.2. Tipos de Cookies: Usamos cookies de sess&atilde;o que expiram quando voc&ecirc; fecha o navegador e cookies persistentes que permanecem em seu dispositivo por um per&iacute;odo espec&iacute;fico. Tamb&eacute;m utilizamos cookies de terceiros para an&aacute;lise de tr&aacute;fego e publicidade.</p>\r\n<p>3.3. Controle de Cookies: Voc&ecirc; pode controlar o uso de cookies ajustando as configura&ccedil;&otilde;es do seu navegador. No entanto, desativar cookies pode afetar a funcionalidade de nosso blog.</p>\r\n<p>4. Como Usamos Suas Informa&ccedil;&otilde;es</p>\r\n<p>4.1. Usamos suas informa&ccedil;&otilde;es para fornecer e melhorar nosso blog, responder a coment&aacute;rios e intera&ccedil;&otilde;es, personalizar a experi&ecirc;ncia do usu&aacute;rio, e enviar comunica&ccedil;&otilde;es relacionadas ao blog.</p>\r\n<p>5. Compartilhamento de Informa&ccedil;&otilde;es</p>\r\n<p>N&atilde;o vendemos ou alugamos suas informa&ccedil;&otilde;es pessoais a terceiros. Compartilhamos informa&ccedil;&otilde;es apenas quando necess&aacute;rio, como para responder a coment&aacute;rios ou cumprir obriga&ccedil;&otilde;es legais.</p>\r\n<p>6. Seguran&ccedil;a das Informa&ccedil;&otilde;es</p>\r\n<p>Tomamos medidas para proteger suas informa&ccedil;&otilde;es, incluindo o uso de protocolos de seguran&ccedil;a. No entanto, nenhum m&eacute;todo de transmiss&atilde;o de dados &eacute; 100% seguro, e n&atilde;o podemos garantir a seguran&ccedil;a absoluta.</p>\r\n<p>7. Altera&ccedil;&otilde;es a esta Pol&iacute;tica</p>\r\n<p>Reservamo-nos o direito de atualizar esta pol&iacute;tica de privacidade e uso de cookies a qualquer momento. Quaisquer altera&ccedil;&otilde;es ser&atilde;o refletidas nesta p&aacute;gina com a data da &uacute;ltima atualiza&ccedil;&atilde;o.</p>\r\n<p>8. Contato</p>\r\n<p>Se voc&ecirc; tiver alguma d&uacute;vida sobre esta pol&iacute;tica, entre em contato conosco em contato@nucleoadvance.com.</p>\r\n<p>&Uacute;ltima atualiza&ccedil;&atilde;o: 12/10/2023</p>','uploads/1697137766dan-nelson-EhbuqJYNCRk-unsplash.jpg','politica-de-privacidade-e-uso-de-cookies',227,'2024-07-30 10:21:39','2023-10-12 15:36:11','2023-10-21 16:41:37'),(15,1,12,'Fórmula Negócio Online','10 motivos únicos para compra \"Fórmula Negócio Online\"','<p>10 alguns motivos gerais que muitas pessoas consideram ao comprar o curso Fórmula Negócio Online.</p><p>1. Aprendizado em Marketing Digital: Aprender estratégias eficazes de marketing digital para promover produtos e serviços online.</p><p>2. Criação de Negócio Online: Orientação passo a passo para criar um negócio na internet, desde a escolha de nichos até a construção de sites.</p><p>3. Geração de Tráfego: Ensina como atrair tráfego qualificado para seu site ou funil de vendas.</p><p>4. Estratégias de Vendas: Aprenda a criar estratégias de vendas eficazes para aumentar as conversões.</p><p>5. Geração de Receita: Como ganhar dinheiro online através de diversas fontes de receita, como afiliação, produtos próprios, anúncios, entre outros.</p><p>6. Suporte e Comunidade: Muitos cursos oferecem suporte e acesso a uma comunidade online de outros empreendedores, o que pode ser valioso para esclarecer dúvidas.</p><p>7. Atualizações Contínuas: A garantia de acesso a atualizações e novos conteúdos à medida que as estratégias de negócios online evoluem.</p><p>8. Flexibilidade: Acesso 24/7 ao conteúdo, permitindo que você aprenda no seu próprio ritmo.</p><p>9. Resultados Comprovados: Casos de estudo e depoimentos de pessoas que alcançaram sucesso após seguir o programa.</p><p>10. Garantia de Satisfação: Alguns cursos oferecem garantias de satisfação, permitindo que você recupere seu investimento se não estiver satisfeito.</p><p>Antes de comprar qualquer curso, é importante fazer uma pesquisa completa, verificar avaliações e depoimentos, e considerar suas próprias metas e necessidades. Certifique-se de que o curso que você escolher seja relevante para o seu nicho de negócios e objetivos.</p><p>Veja os depoimentos dos alunos no site oficial.</p><p><a href=\"https://go.hotmart.com/B38397431W?ap=305a\" target=\"_blank\">Página De Depoimentos De Alunos</a></p><h4 style=\"text-align: center; \"><b style=\"font-size: 24px;\">        Clique Abaixo e </b><span style=\"font-size: 24px;\"><b>inscreva</b></span><b style=\"font-size: 24px;\"> agora mesmo no site oficial.</b></h4><div style=\"text-align: center;\"><h3><b><font color=\"#00ff00\"><a href=\"https://go.hotmart.com/B38397431W\" target=\"_blank\">QUERO ME INSCREVER AGORA</a></font></b></h3><div><br></div></div><div><div style=\"font-weight: bold; text-align: center;\"><br></div></div><div><span style=\"color: rgb(255, 255, 255); font-family: Roboto, sans-serif; font-size: 40px; font-weight: 700; letter-spacing: 2px; text-align: center; background-color: rgb(77, 213, 68);\"><br></span></div>','uploads/1698023787fno.jpg','frmula-negcio-online',106,'2024-07-30 10:21:40','2023-10-22 22:16:27','2023-10-22 22:25:57'),(16,1,13,'Como fazer um backup e restaurar um banco de dados MySQL','Guia passo a passo sobre como fazer um backup e restaurar um banco de dados MySQL ','<p>fazer um backup e restaurar um banco de dados MySQL<span style=\"text-align: var(--bs-body-text-align);\">Fazer backup e restaurar um banco de dados MySQL é uma tarefa essencial para garantir a segurança dos seus dados. Abaixo, vou fornecer um guia passo a passo sobre como fazer um backup e restaurar um banco de dados MySQL usando a linha de comando. Certifique-se de ter acesso de superusuário (root) ou privilégios suficientes no MySQL para realizar essas operações.</span></p><h5><b>Fazendo Backup do Banco de Dados MySQL:</b></h5><p><b>Passo 1: Acesse o Terminal:</b></p><p>Abra um terminal ou prompt de comando, dependendo do seu sistema operacional.</p><p><b>Passo 2: Faça login no MySQL:</b></p><p>Use o seguinte comando para fazer login no MySQL. Você será solicitado a inserir a senha do usuário root ou outro usuário com privilégios de backup.</p><table class=\"table table-bordered\"><tbody><tr><td>$ mysql -u seu_usuario -p</td></tr></tbody></table><p>Substitua seu_usuario pelo nome do usuário do MySQL.</p><p><b>Passo 3: Crie o Backup:</b></p><p>Para criar um backup do banco de dados, use o comando mysqldump. O exemplo a seguir cria um backup do banco de dados seu_banco_de_dados e o redireciona para um arquivo chamado backup.sql:</p><table class=\"table table-bordered\"><tbody><tr><td>$ mysqldump -u seu_usuario -p seu_banco_de_dados &gt; backup.sql<br></td></tr></tbody></table><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Substitua seu_usuario pelo nome do usuário do MySQL, seu_banco_de_dados pelo nome do banco de dados que deseja fazer backup e backup.sql pelo nome que você deseja dar ao arquivo de backup.</span></p><p>Você será solicitado a inserir a senha do usuário.</p><h5><b>Restaurando um Banco de Dados MySQL a partir do Backup:</b></h5><p><b>Passo 1: Acesse o Terminal:</b></p><p>Abra um terminal ou prompt de comando.</p><p><b>Passo 2: Faça login no MySQL:</b></p><p>Use o seguinte comando para fazer login no MySQL:</p><table class=\"table table-bordered\"><tbody><tr><td>$ mysql -u seu_usuario -p<br></td></tr></tbody></table><p><span style=\"font-size: var(--bs-body-font-size); text-align: var(--bs-body-text-align);\"><b>Passo 3: Crie um Banco de Dados Vazio:</b></span></p><p>Se você deseja restaurar o backup para um novo banco de dados, crie um banco de dados vazio. Use o seguinte comando:</p><table class=\"table table-bordered\"><tbody><tr><td>$ CREATE DATABASE novo_banco_de_dados;<br></td></tr></tbody></table><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Substitua novo_banco_de_dados pelo nome do banco de dados que deseja criar.</span></p><p><b>Passo 4: Restaure o Backup:</b></p><p>Use o comando mysql para restaurar o backup no novo banco de dados ou no banco de dados existente:</p><table class=\"table table-bordered\"><tbody><tr><td>$ mysql -u seu_usuario -p novo_banco_de_dados &lt; backup.sql<br></td></tr></tbody></table><p><span style=\"font-size: var(--bs-body-font-size); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">Substitua seu_usuario pelo nome do usuário do MySQL, novo_banco_de_dados pelo nome do banco de dados no qual deseja restaurar os dados e backup.sql pelo nome do arquivo de backup que você deseja restaurar.</span></p><p>Você será solicitado a inserir a senha do usuário.</p><p>Depois de seguir esses passos, você terá feito um backup do banco de dados MySQL e também terá restaurado o banco de dados a partir desse backup, seja em um banco de dados existente ou em um novo banco de dados vazio. Certifique-se de substituir os valores no comando pelos nomes específicos do seu banco de dados e usuário.</p>','uploads/1698289712mysql.jpg','como-fazer-um-backup-e-restaurar-um-banco-de-dados-mysql',112,'2024-07-30 10:21:40','2023-10-25 23:56:56','2023-10-26 00:09:04');
/*!40000 ALTER TABLE `postagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_categorias`
--

DROP TABLE IF EXISTS `status_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_categorias`
--

LOCK TABLES `status_categorias` WRITE;
/*!40000 ALTER TABLE `status_categorias` DISABLE KEYS */;
INSERT INTO `status_categorias` VALUES (1,'Ativa','2023-09-12 13:26:08',NULL),(2,'Inativa','2023-09-12 13:26:08',NULL);
/*!40000 ALTER TABLE `status_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_usuarios`
--

DROP TABLE IF EXISTS `status_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_usuarios`
--

LOCK TABLES `status_usuarios` WRITE;
/*!40000 ALTER TABLE `status_usuarios` DISABLE KEYS */;
INSERT INTO `status_usuarios` VALUES (1,'Ativado','2023-09-08 13:11:54',NULL),(2,'Inativo','2023-09-08 13:11:54',NULL),(3,'Aguardando confirmação','2023-09-08 13:11:54',NULL);
/*!40000 ALTER TABLE `status_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_acessos`
--

DROP TABLE IF EXISTS `tipo_acessos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_acessos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_acessos`
--

LOCK TABLES `tipo_acessos` WRITE;
/*!40000 ALTER TABLE `tipo_acessos` DISABLE KEYS */;
INSERT INTO `tipo_acessos` VALUES (1,'Administrador','2023-09-08 13:09:11',NULL),(2,'Usuário','2023-09-08 13:09:11',NULL);
/*!40000 ALTER TABLE `tipo_acessos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_usuario_id` int(11) DEFAULT '1',
  `tipo_acesso_id` int(11) DEFAULT '2',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `status_usuario_id` (`status_usuario_id`),
  KEY `tipo_acesso_id` (`tipo_acesso_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`status_usuario_id`) REFERENCES `status_usuarios` (`id`),
  CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`tipo_acesso_id`) REFERENCES `tipo_acessos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Daniel Próspero Ribeiro','danielprosperoribeiro@outlook.com','$2y$10$HFqVyuknD4G6i84cV1svQ.fiF4K8gJKl2ycv6FeJBce8oYNsS/1mC','uploads/1694395597daniel-sorrindo-quad2.jpeg',1,1,'2023-09-10 15:42:15','2023-10-21 21:57:42'),(2,'Daniel Prospero ','danielprosperoribeiro@outlook.com.br','$2y$10$Z8yIEzpwBtQp8GTiCMHFWeg06Cr.GU3nMG.IkixB4HaS5ys..r.PO','uploads/1697670828família_ribeiro.jpeg',1,2,'2023-09-08 20:09:13','2023-10-21 21:58:05');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dani3764_nucleoadvance'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-04 12:17:49
