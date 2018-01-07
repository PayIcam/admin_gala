<div class = 'container all_index'>
    <?php
    require 'include/html/index/index_title_search.php';

    if (isset($_SESSION['search_match'])) {echo htmlspecialchars($_SESSION['search_match']); unset($_SESSION['search_match']);}
    ?>
    <div class="change_page">
        <?php
        if ($page>2) { first_page();} if ($page>1) { prev_page();} if ($nb_pages_max >1 and $page <$nb_pages_max){ next_page();} if($page<$nb_pages_max-1) last_page($nb_pages_max);
        ?>
    </div>
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
    <div class="change_page">
        <?php
        if ($page>2) { first_page();} if ($page>1) { prev_page();} if ($nb_pages_max >1 and $page <$nb_pages_max){ next_page();} if($page<$nb_pages_max-1) last_page($nb_pages_max);
        ?>
    </div>
</div>