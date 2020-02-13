<?php

require "header.php";

?>




<main>

<div class="wrapper-main">

<section class="section-default">

<?php

if (isset($_SESSION['userId'])) {

    echo "You are logged in";

} else {

    echo "You are logged out";


}


?>




</section>

</div>

</main>


<?php

require "footer.php";

?>