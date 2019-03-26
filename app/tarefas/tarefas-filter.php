<?php 
$status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);

$query[] = $status == 'checked' ? "t.status = '1'" : null;
$query[] = $status == 'all' ? "t.status = '0' OR t.status = '1'" : null;
///$query[] = empty($status) ? "t.status = '0'" : null;


$where = (count(array_filter($query, 'strlen')) > 0) ? '('.implode(' AND ', array_filter($query, 'strlen')).')' :'';