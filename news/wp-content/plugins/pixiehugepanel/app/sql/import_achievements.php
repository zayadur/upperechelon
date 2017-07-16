<?php
$wpdb->query("DROP TABLE IF EXISTS `{$tables['achievements']}`");
$wpdb->query("CREATE TABLE IF NOT EXISTS `{$tables['achievements']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `team_id` int(11) unsigned NOT NULL references {$tables['achievements']}(id),
        `name` varchar(64) NOT NULL,
        `place` varchar(24) NOT NULL,
        `description` varchar(24) NOT NULL,
        `created_at` DATETIME NOT NULL
    )" . $wpdb->get_charset_collate() . ";");

$sql = <<<SQL
INSERT INTO `{$tables['achievements']}` (`id`, `team_id`, `name`, `place`, `description`, `created_at`) VALUES
(1, 1, 'ESL Tournament 2017', '1st place', '25th July', '2017-06-15 22:52:30'),
(2, 1, 'ESL GAMING NEW YORK', '2nd place', '13 August', '2017-06-15 22:52:46'),
(3, 1, 'MLG Columbus 2016', '3rd place', '30 October', '2017-06-15 22:52:59'),
(4, 1, 'TWC CS:GO 2017', '1st place', '25th July', '2017-06-15 22:53:15'),
(5, 1, 'SR. STARS LEAGUE SERIES', '4th place', '01 December', '2017-06-15 22:55:09'),
(6, 3, 'ESL GAMING NEW YORK', '1st place', '25th July', '2017-06-16 01:24:07'),
(7, 3, 'ESL Tournament 2017', '2nd place', '30 October', '2017-06-16 01:24:16'),
(8, 3, 'MLG Columbus 2016', '3rd place', '26 September', '2017-06-16 01:24:26'),
(9, 3, 'TWC CS:GO 2017', '4th place', '10 January', '2017-06-16 01:24:38'),
(10, 3, 'MLG New York 2015', '2nd place', '8 August', '2017-06-16 01:25:00'),
(11, 2, 'ESL GAMING NEW YORK', '1st place', '25th July', '2017-06-16 01:24:07'),
(12, 2, 'ESL Tournament 2017', '2nd place', '30 October', '2017-06-16 01:24:16'),
(13, 2, 'MLG Columbus 2016', '3rd place', '26 September', '2017-06-16 01:24:26'),
(14, 2, 'TWC CS:GO 2017', '4th place', '10 January', '2017-06-16 01:24:38'),
(15, 2, 'MLG New York 2015', '2nd place', '8 August', '2017-06-16 01:25:00'),
(16, 4, 'ESL GAMING NEW YORK', '1st place', '25th July', '2017-06-16 01:24:07'),
(17, 4, 'ESL Tournament 2017', '2nd place', '30 October', '2017-06-16 01:24:16'),
(18, 4, 'MLG Columbus 2016', '3rd place', '26 September', '2017-06-16 01:24:26'),
(19, 4, 'TWC CS:GO 2017', '4th place', '10 January', '2017-06-16 01:24:38'),
(20, 4, 'MLG New York 2015', '2nd place', '8 August', '2017-06-16 01:25:00');
SQL;
$wpdb->query($sql);