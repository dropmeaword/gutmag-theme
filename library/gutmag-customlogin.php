<?php
/* @lfernandez begin: custom logo */
function custom_login_logo() {
    echo '<style type="text/css">
				body.login {
					background: #ffffff;
				}
				
				.login form {
					background: #d0d0d0 !important;
				}
				
				textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="file"]:focus, input[type="button"]:focus, input[type="submit"]:focus, input[type="reset"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="url"]:focus, select:focus {
					border-color: #404040;
				}

        h1 a { 
						background-image:url('.get_bloginfo('template_directory').'/images/gutmag_logo.png) !important; 
				}
    		</style>';
}

add_action('login_head', 'custom_login_logo');
/* @lfernandez end: custom logo */
?>