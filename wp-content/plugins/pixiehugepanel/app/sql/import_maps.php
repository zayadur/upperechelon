<?php
$wpdb->query("DROP TABLE IF EXISTS `{$tables['maps']}`");
$wpdb->query("CREATE TABLE IF NOT EXISTS `{$tables['maps']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(64) NOT NULL,
        `image` TEXT NOT NULL,
        `created_at` DATETIME NOT NULL
    )" . $wpdb->get_charset_collate() . ";");

$sql = <<<SQL
INSERT INTO `{$tables['maps']}` (`id`, `name`, `image`, `created_at`) VALUES
(1, 'De Dust 2', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/de-dust2.jpg', '2017-06-16 00:04:07'),
(2, 'De Inferno', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/De-Inferno.jpg', '2017-06-16 00:04:37'),
(3, 'De Nuke', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/De-nuke.jpg', '2017-06-16 00:05:02'),
(4, 'De Inferno', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/De-Inferno.jpg', '2017-06-28 22:22:53');
SQL;
$wpdb->query($sql);