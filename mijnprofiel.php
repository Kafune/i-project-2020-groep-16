<?php
include_once('includes/header.php');
?>
<title>Mijn Profiel</title>
<link rel="stylesheet" href="styles/bulma.min.css">
<link rel="stylesheet" href="styles/css/mystyles.css">


<!-- About -->
<section class="section">
    <!-- Title -->
    <div class="section-heading is-centered">
        <h3 class="title is-2">Mijn Profiel</h3>
    </div>

    <div class="columns has-same-height is-gapless">
        <div class="column">
            <!-- Profile -->
            <div class="card">
                <div class="card-content">
                    <h3 class="title is-4">Profile</h3>

                    <div class="content">
                        <table class="table-profile">
                            <tr>
                                <th colspan="1"></th>
                                <th colspan="2"></th>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td>Guru's Lab</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>0123-456789</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>minion@despicable.me</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="buttons has-addons is-centered">
                        <a href="#" class="button is-link">Github</a>
                        <a href="#" class="button is-link">LinkedIn</a>
                        <a href="#" class="button is-link">Twitter</a>
                        <a href="#" class="button is-link">CodeTrace</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <!-- Profile picture -->
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="https://source.unsplash.com/random/1280x960" alt="Placeholder image">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once('includes/footer.html');
?>
