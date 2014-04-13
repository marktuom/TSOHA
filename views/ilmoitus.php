<?php if (!empty($_SESSION['ilmoitus'])): ?>
  <div class="alert alert-danger">
    <?php echo $_SESSION['ilmoitus']; ?>
  </div>
<?php
  // Samalla kun viesti näytetään, se poistetaan istunnosta,
  // ettei se näkyisi myöhemmin jollain toisella sivulla uudestaan.
  unset($_SESSION['ilmoitus']); 
  endif;
?>