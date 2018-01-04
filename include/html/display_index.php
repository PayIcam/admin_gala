<div class = 'container all_index'>
    <?php
    require 'include/html/index/index_title_search.php';
    if (isset($_SESSION['search_match'])) {echo htmlspecialchars($_SESSION['search_match']); unset($_SESSION['search_match']);}
    if ($nb_pages_max >1 and $page <$nb_pages_max){ next_page();}
    ?>
    <section class="row" id="tableau">
        <table class="table table-striped">
            <?php
            require'include/html/index/table_head_index.php';
            ?>
            <tbody>
            <?php
            foreach ($invite as $guest)
            {
                $message_invite = nombre_invites($guest);
                require 'include/html/index/table_row_index.php';
            }
            ?>
            </tbody>
        </table>
    </section>
    <?php if ($nb_pages_max >1 and $page <$nb_pages_max){ next_page();} ?>
</div>