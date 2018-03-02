# WORDPRESS #

## Um endereço para chamar de seu - alteraçao no .htaccess ##
Se você está habituado a utilizar o WordPress provavelmente já digita “/wp-login” 
ou “/wp-admin” após o endereço de qualquer site que utilize a plataforma para 
entrar na sua conta. Mas talvez para o seu cliente seria mais fácil de lembrar do 
endereço se a url tivesse um nome mais amigável como “/administrador” ou até mesmo 
apenas “/login”, certo?

Para isto vamos precisar editar o arquivo .htaccess. Este arquivo fica geralmente 
na pasta raíz do seu diretorio do WordPress. Dependendo das configurações do seu 
servidor ele pode estar oculto. Para modificar a url do seu painel de administração 
basta inserir esta linha no topo do seu arquivo (substituindo “seu-site” pela sua 
url):

RewriteRule ^login$ http://seu-site.com.br/wp-login.php [NC,L]

## AutoUpdate - alteração no wp-config.pnp
define('WP_AUTO_UPDATE_CORE', true);
define('AUTOMATIC_UPDATER_DISABLED', false);

## Inserindo seu logotipo - alteraçao no style.css
body.login div#login h1 a {
    background-image: url(<?php echo get_bloginfo('template_directory'); ?>/img/site-logo.png);
}

## Custom WordPress Login Logo - alteração no functions.php
function my_login_logo() { ?>
   body.login div#login h1 a {
        background-image: url(/img/site-login-logo.png);
        padding-bottom: 30px;
   }
 
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

## Alterando o ícone da Dashboard - alteração no functions.php
//Custom dashboard logo
add_action('admin_head', 'my_custom_logo');
function my_custom_logo() {
echo '#wp-admin-bar-wp-logo .ab-icon {background: url('.get_bloginfo('template_directory').'/img/site-logo.png) no-repeat center top !important; }';
}

## Como modificar o texto do footer  - alteração no functions.php
// Customizar o Footer do WordPress
function remove_footer_admin () {
	echo '© <a href="mailto:hmjsite@gmail.com">Henry Jr</a> - Desenvolvimento inteligente';
	}
add_filter('admin_footer_text', 'remove_footer_admin');

## Links - Referencias

Customizing the Login Form http://codex.wordpress.org/Customizing_the_Login_Form

Creating Admin Themes http://codex.wordpress.org/Creating_Admin_Themes

WordPress Code Snippets http://wp-snippets.com/

How To Customize The WordPress Admin Easily http://www.smashingmagazine.com/2012/05/17/customize-wordpress-admin-easily/
