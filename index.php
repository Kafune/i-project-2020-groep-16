<?php
include_once ("includes/header.php");
?>

<?php
if(!isset($_SESSION['email'])) :
?>
<section>
    <form action="scripts/register.php" method="post">
        <label for="email">E-mail</label>
        <input type="email" name="email">
        <button type="submit" name="emailCheck">Check e-mail</button>
    </form>
</section>

<?php
endif;

if(isset($_SESSION['email'])) :
?>
    <section>
        Stuur verificatie code in die via email is gestuurd.
        <?=$_SESSION['email']?>
        <?php
        unset($_SESSION['email']);
        ?>
        <form action="scripts/register.php" method="post">
            <label for="code">Verificatiecode</label>
            <input type="text" name="code">
            <button type="submit" name="codeCheck">Check verificatiecode</button>
        </form>
    </section>

<?php
    endif;
?>

<?php
include_once ("includes/footer.php");
?>
