
<div class="span11">
    <div class="hero-unit">
        <h1>Welcome</h1>
        <?php 

        //$temp = $sf_user->getUsername();
        

		if ($sf_user->hasCredential('admin')) {
			echo 'admin';
		}elseif ($sf_user->hasCredential('manage_content')) {
			echo 'production';
		}elseif ($sf_user->hasCredential('manage_project')) {
			echo 'Campain Manager';
		}elseif ($sf_user->hasCredential('read_project')) {
			echo 'client';
		}

        ?>
    </div>
</div>
<!--/row-->