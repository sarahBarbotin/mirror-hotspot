<?php if (!empty($args['pagination_links'])) { ?>
    <nav class="blog-pagination justify-content-center d-flex mb-5">
        <ul class="pagination">
            <?php foreach ($args['pagination_links'] as $paginationLink) { ?>
            <?php
                if (str_contains($paginationLink, '«')) {
                    $paginationLink = str_replace('«', '<i class="ti-angle-left"></i>', $paginationLink);
                }
                if (str_contains($paginationLink, '»')) {
                    $paginationLink = str_replace('»', '<i class="ti-angle-right"></i>', $paginationLink);
                }
                if (str_contains($paginationLink, 'current')) {
                    $paginationLink = str_replace('class="', 'class="active ', $paginationLink);
                }
                echo ('<li class="page-item">' .
                    $paginationLink
                    . '</li>');
            } ?>
        </ul>
    </nav>
<?php } ?>

