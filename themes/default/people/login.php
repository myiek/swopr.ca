<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/people/login.php
* Used by the core_authentication pod to create the /login page
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>
	<div id="login_join_form">

		<h1>Sign in to <? $POD->siteName(); ?></h1>
		
		<form method="post" id="login" action="<? $POD->siteRoot(); ?>/login" class="valid">
			<input type="hidden" name="redirect" value="<? echo htmlspecialchars($user->get('redirect')); ?>" />
			<p>
				<label for="email">Email:</label>
				<input class="required email text" name="email" id="email" />
			</p>
			
			<p>
				<label for="password">Password:</label>
				<input class="required text" name="password" type="password" id="password" />
			</p>
			
			<p>
				<label for="remember_me">Remember Me:</label>
				<input type="checkbox" name="remember_me" value="true" checked />
			</p>
			
			<p>
				<label for="login">&nbsp;</label>
				<input type="submit"  value="Login" name="login" />
			</p>
			<? if ($POD->libOptions('enable_core_authentication_creation')) { ?>
			<p class="right_align gray">Need an account? <a href="<? $POD->siteRoot(); ?>/join">Join this site!</a></p>
			<? } ?>
			<p class="right_align gray"><a href="<? $POD->siteRoot(); ?>/password_reset">Forgot your password?</a></p>
			

		</form>
	</div>
