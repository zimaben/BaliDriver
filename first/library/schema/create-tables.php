<?php

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

global $wpdb;
$table = $wpdb->prefix . 'tablename';

$charset_collate = $wpdb->get_charset_collate();

$query = "CREATE TABLE $table (
    company_id      INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    company_name    VARCHAR(28),
    company_status  VARCHAR(28),
    company_userid  INTEGER, 
    company_status_transaction VARCHAR(28)
  ) $charset_collate";
  
$exe = \dbDelta( $query );