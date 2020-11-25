<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
<div class="container">
  <a class="navbar-brand" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT . '/pages/about'; ?>">Über uns</a>
      </li> 
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <?php if( $_SESSION['user_id']) : ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Hallo <?php echo $_SESSION['user_name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;|</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT .'/users/logout'; ?>">Logout</a>
        </li>  
      <?php else : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT .'/users/register'; ?>">Registrierung</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT . '/users/login'; ?>">Anmeldung</a>
      </li> 
      <?php endif; ?>
    </ul>
    
  </div>
  
</nav>