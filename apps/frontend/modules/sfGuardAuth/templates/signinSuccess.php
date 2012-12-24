
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" class="well">
  <h1>Login</h1>
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="Log in" class="btn btn-primary" />
</form>
