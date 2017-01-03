<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tip Calculator</title>
    <link rel="stylesheet" href="./tip-calculator.css">
  </head>
  <body>
    <?php
      if ($_POST) {
        // Sanitize Tip Input
        $_POST['tip'] = str_replace("%", "", $_POST['tip']);
        if ($_POST['tip'] == "custom") {
          $_POST['tip'] = $_POST['customTip'];
        }

        // Error check
        if ($_POST['bill'] < 0 || !$_POST['bill']) {
          $error_message = 'Invalid Bill Subtotal.';
        } elseif ($_POST['tip'] < 0) {
          $error_message = 'A negative tip huh? Real nice.';
        } elseif ($_POST['tip'] > 100) {
          $error_message = 'You can not tip over 100%, but nice try!';
        } elseif ($_POST['personCount'] < 1) {
          $error_message = 'Invalid person count.';
        } else {
          $tip = $_POST['bill'] * ($_POST['tip'] / 100);
          $total = $_POST['bill'] + $tip;
          $tipEa = $tip / $_POST['personCount'];
          $totalEa = $total / $_POST['personCount'];
        }
      }
    ?>

    <form class="form-container" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
      <div class="form-title">
        <h2>Tip Calculator</h2>
      </div>
      <div class="form-title">Bill Subtotal:</div>
      <input class="form-field" type="text" name="bill" placeholder="10.99" /><br />

      <div class="form-title">Tip Percentage:</div>
      <div class="white-text">
        <input type="radio" name="tip" value="10%">10%
        <input type="radio" name="tip" value="15%" checked="True">15%
        <input type="radio" name="tip" value="20%">20%<br>
        <input type="radio" name="tip" value="custom">custom
        <input type="text" name="customTip" placeholder="" /><br />
      </div>
      <br>

      <div class="form-title"># of Person(s):</div>
      <input class="form-field" type="text" name="personCount" value="1" /><br />

      <div class="submit-container">
      <input class="submit-button" type="submit" value="Submit"/>
      </div>

      <?php if ($_POST && $error_message == ""): ?>
        <div class="results white-text">
          <p><?php echo "Tip: " . $tip ?></p>
          <p><?php echo "Total: " . $total ?></p>
          <p><?php echo "Tip Each: " . $tipEa ?></p>
          <p><?php echo "Total Each: " . $totalEa ?></p>
        </div>
      <?php endif; ?>
      <div class="error-box white-text">
        <p><?php echo $error_message ?></p>
      </div>
    </form>
  </body>
</html>
