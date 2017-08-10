<?php
$wpdb->query("DROP TABLE IF EXISTS `{$tables['boardmembers']}`");
$wpdb->query("CREATE TABLE IF NOT EXISTS `{$tables['boardmembers']}` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `fullname` varchar(255) NOT NULL,
        `role` varchar(255) NOT NULL,
        `avatar` TEXT NULL,
        `category` varchar(32),
        `social` TEXT NULL,
        `created_at` DATETIME NOT NULL
    )" . $wpdb->get_charset_collate() . ";");

$sql = <<<SQL
INSERT INTO `{$tables['boardmembers']}` (`id`, `fullname`, `role`, `avatar`, `category`, `social`, `created_at`) VALUES
(1, 'Evan Miles', 'Chief Executive Officer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member1.png', 'Management', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:26:58'),
(2, 'Billie Watson', 'Senior Analyst', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member2.png', 'Management', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:33:54'),
(3, 'Shane Mullins', 'Junior Journalist', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member3.png', 'Management', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:34:35'),
(4, 'Ronald Johnston', 'UI Designer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member4.png', 'Management', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:35:08'),
(6, 'Billie Watson', 'Senior Analyst', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member2.png', 'Analysts', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:33:54'),
(7, 'Shane Mullins', 'Junior Journalist', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member3.png', 'Analysts', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:34:35'),
(8, 'Ronald Johnston', 'UI Designer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member4.png', 'Analysts', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:35:08'),
(11, 'Shane Mullins', 'Junior Journalist', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member3.png', 'Journalists', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:34:35'),
(12, 'Ronald Johnston', 'UI Designer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member4.png', 'Journalists', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:35:08'),
(13, 'Evan Miles', 'Chief Executive Officer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member1.png', 'Designer', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:26:58'),
(14, 'Billie Watson', 'Senior Analyst', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member2.png', 'Designer', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:33:54'),
(15, 'Shane Mullins', 'Junior Journalist', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member3.png', 'Designer', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:34:35'),
(16, 'Ronald Johnston', 'UI Designer', 'http://themes.pixiesquad.com/pixiehuge/orange-elite/wp-content/uploads/2017/06/member4.png', 'Designer', '{"twitter":"http://facebook.com/pixiesquad","facebook":"http://facebook.com/pixiesquad","linkedin":"http://facebook.com/pixiesquad"}', '2017-06-16 00:35:08');
SQL;
$wpdb->query($sql);