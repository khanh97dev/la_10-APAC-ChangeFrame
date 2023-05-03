<?php

// per page default as 5
define('K_PER_PAGE', "rows-per-page");
define('V_PER_PAGE', 5);

// page default as 1
define('K_PAGE', "page");
define('V_PAGE', 1);

// sort default for column
define('K_SORT_BY', "sort-by");
define('V_SORT_BY', "null");

//
define('K_DIRECTION', "descending");
define('V_DIRECTION', "asc");

// latest
define('IN_REQUEST_TABLE', [
    K_PER_PAGE,
    K_PAGE,
    K_SORT_BY,
]);
