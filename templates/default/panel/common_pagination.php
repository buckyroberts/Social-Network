<?php

/**
 * $BUCKYS_GLOBALS['commonPagination'] should be set by  function fn_buckys_pagination
 */

$paginationData = $BUCKYS_GLOBALS['commonPagination'];

$pagination = new Pagination($paginationData['totalRecords'], COMMON_ROWS_PER_PAGE, $paginationData['currentPage']);

$pagination->renderPaginate($paginationData['baseUrl'], $paginationData['currentRecords']);



