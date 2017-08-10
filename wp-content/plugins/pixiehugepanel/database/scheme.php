<?php

$sponsors = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['sponsors']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(64) NOT NULL,
        `logo` TEXT,
        `url` TEXT,
        `social` TEXT NULL,
        `about` TEXT NULL,
        `sponsor_category` varchar(24) NULL,
        `sponsor_type` varchar(24) NOT NULL DEFAULT 1,
        `created_at` DATETIME NOT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $sponsors );

$teams = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['teams']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(64) NOT NULL,
        `subtitle` varchar(24) NOT NULL,
        `slug` varchar(64) NOT NULL,
        `game_logo` TEXT  NOT NULL,
        `team_logo` TEXT NOT NULL,
        `cover` TEXT NOT NULL,
        `thumbnail` TEXT NOT NULL,
        `stats` TEXT NULL,
        `about` TEXT NULL,
        `country` varchar(48) NULL,
        `my_team` int(11) NOT NULL DEFAULT 0,
        `year_founded` varchar(15) NULL,
        `created_at` DATETIME NOT NULL

    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $teams );

$achievements = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['achievements']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `team_id` int(11) unsigned NOT NULL references {$this->tables['teams']}(id),
        `name` varchar(64) NOT NULL,
        `place` varchar(24) NOT NULL,
        `description` varchar(24) NOT NULL,
        `created_at` DATETIME NOT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $achievements );

$players = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['players']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `team_id` int(11) unsigned NOT NULL references {$this->tables['teams']}(id),
        `firstname` varchar(32) NOT NULL,
        `lastname` varchar(32) NOT NULL,
        `nick` varchar(32) NOT NULL,
        `slug` varchar(64) NOT NULL,
        `avatar` TEXT NOT NULL,
        `cover` TEXT NOT NULL,
        `role_icon` TEXT NULL,
        `about` TEXT NULL,
        `social` TEXT NULL,
        `role` varchar(32) NOT NULL,
        `country` varchar(48) NULL,
        `age` varchar(32) NULL,
        `stats` TEXT NULL,
        `equipment` TEXT NULL,
        `orderNum` int(11) NULL DEFAULT NULL,
        `created_at` DATETIME NOT NULL

    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $players );

$streams = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['streams']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `author` varchar(255) NOT NULL,
        `thumbnail` TEXT,
        `link` TEXT,
        `preview` TEXT,
        `category` varchar(24),
        `created_at` DATETIME NOT NULL

    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $streams );

$matches = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['matches']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `slug` varchar(64) NOT NULL,
        `game` varchar(64) NOT NULL,
        `startdate` DATETIME NOT NULL,
        `score_a` VARCHAR(6) DEFAULT NULL,
        `score_b` VARCHAR(6) DEFAULT NULL,
        `status` int(11) NULL DEFAULT NULL,
        `team_a_id` int(11) unsigned NOT NULL references {$this->tables['teams']}(id),
        `team_a_name` varchar(64) NOT NULL,
        `team_a_logo` TEXT NOT NULL,
        `team_b_id` int(11) unsigned NOT NULL references {$this->tables['teams']}(id),
        `team_b_name` varchar(64) NOT NULL,
        `team_b_logo` TEXT NOT NULL,
        `stream` int(11) unsigned NOT NULL references {$this->tables['streams']}(id),
        `details` TEXT NULL,
        `maps` TEXT NULL,
        `created_at` DATETIME NOT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $matches );

$boardmembers = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['boardmembers']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `fullname` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL,
        `avatar` TEXT NULL,
        `category` varchar(32),
        `social` TEXT NULL,
        `created_at` DATETIME NOT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta( $boardmembers );

$maps = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['maps']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(64) NOT NULL,
        `image` TEXT NOT NULL,
        `created_at` DATETIME NOT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta($maps);

$sections = "
    CREATE TABLE IF NOT EXISTS `{$this->tables['sections']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(64) NOT NULL,
        `orderNum` int(11) NULL DEFAULT NULL
    ) " . $wpdb->get_charset_collate() .  " ;";
dbDelta($sections);

$sectionTable = $this->tables['sections'];
$sectionExists = $wpdb->query("SELECT `id` FROM `{$sectionTable}` WHERE `id`='5'");

if(!$sectionExists) {

    $sql = <<<SQL
        INSERT INTO `{$sectionTable}` (`id`, `name`, `orderNum`) VALUES
        (1, 'News', 0),
        (2, 'Team', 1),
        (3, 'Match', 2),
        (4, 'Twitter', 3),
        (5, 'Stream', 4)
SQL;
    dbDelta($sql);
}

