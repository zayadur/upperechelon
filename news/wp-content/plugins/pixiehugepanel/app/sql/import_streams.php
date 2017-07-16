<?php
$wpdb->query("DROP TABLE IF EXISTS `{$tables['streams']}`");
$wpdb->query("CREATE TABLE IF NOT EXISTS `{$tables['streams']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `author` varchar(255) NOT NULL,
        `thumbnail` TEXT,
        `link` TEXT,
        `preview` TEXT,
        `category` varchar(24),
        `created_at` DATETIME NOT NULL
    )" . $wpdb->get_charset_collate() . ";");

$sql = <<<SQL
INSERT INTO `{$tables['streams']}` (`id`, `title`, `author`, `thumbnail`, `link`, `preview`, `category`, `created_at`) VALUES
(1, 'EA hit with Battlefield 4 lawsuit but does it have merit?', 'CohhCarnage', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/thumbnail.jpg', 'https://www.twitch.tv/cohhcarnage', 'https://static-cdn.jtvnw.net/jtv_user_pictures/cohhcarnage-profile_banner-bcb1b1b8e6194799-480.png', 'twitch', '2017-06-15 23:48:56'),
(2, 'Amazing Call of Duty 4 in action', 'CohhCarnage', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/thumbnail2.jpg', 'https://www.twitch.tv/cohhcarnage', 'https://static-cdn.jtvnw.net/jtv_user_pictures/cohhcarnage-profile_banner-bcb1b1b8e6194799-480.png', 'twitch', '2017-06-15 23:51:55'),
(3, 'Crysis 3 streaming all night long', 'CohhCarnage', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/thumbnail3.jpg', 'https://www.twitch.tv/cohhcarnage', 'https://static-cdn.jtvnw.net/jtv_user_pictures/cohhcarnage-profile_banner-bcb1b1b8e6194799-480.png', 'twitch', '2017-06-15 23:57:50'),
(4, 'EA hit with Battlefield 4 lawsuit but does it have merit?', 'Blizzy', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream1.jpg', 'https://mixer.com/Blizzy', 'https://beam.pro/_latest/assets/img/backgrounds/diablo3-001.jpg', 'mixer', '2017-06-15 23:48:56'),
(5, 'Amazing Call of Duty 4 in action', 'Blizzy', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream2.jpg', 'https://mixer.com/Blizzy', 'https://beam.pro/_latest/assets/img/backgrounds/diablo3-001.jpg', 'mixer', '2017-06-15 23:51:55'),
(6, 'Crysis 3 streaming all night long', 'Blizzy', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream3.jpg', 'https://mixer.com/Blizzy', 'https://beam.pro/_latest/assets/img/backgrounds/diablo3-001.jpg', 'mixer', '2017-06-15 23:57:50'),
(7, 'EA hit with Battlefield 4 lawsuit but does it have merit?', 'EfragTV', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream1.jpg', 'https://www.youtube.com/channel/UCOpNcN46UbXVtpKMrmU4Abg', 'https://static-cdn.jtvnw.net/jtv_user_pictures/efragtv-profile_banner-8ba1700f275272b9-480.png', 'youtube', '2017-06-15 23:48:56'),
(8, 'Amazing Call of Duty 4 in action', 'pixiesquad', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream2.jpg', 'https://www.youtube.com/channel/UCOpNcN46UbXVtpKMrmU4Abg', NULL, 'youtube', '2017-06-15 23:51:55'),
(9, 'Crysis 3 streaming all night long', 'sodapoppin', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/stream3.jpg', 'https://www.youtube.com/channel/UCOpNcN46UbXVtpKMrmU4Abg', 'https://static-cdn.jtvnw.net/jtv_user_pictures/sodapoppin-profile_banner-1c050aa5aed3558d-480.png', 'youtube', '2017-06-15 23:57:50');
SQL;
$wpdb->query($sql);