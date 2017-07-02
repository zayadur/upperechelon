<?php
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

/* create_where_clauses( int[] gen_id, String type )
* This function outputs an SQL WHERE statement for use when grabbing 
* posts and topics */

function create_where_clauses($gen_id, $type)
{
global $db, $auth;

    $size_gen_id = sizeof($gen_id);

        switch($type)
        {
            case 'forum':
                $type = 'forum_id';
                break;
            case 'topic':
                $type = 'topic_id';
                break;
            default:
                trigger_error('No type defined');
        }

    // Set $out_where to nothing, this will be used of the gen_id
    // size is empty, in other words "grab from anywhere" with
    // no restrictions
    $out_where = '';

    if( $size_gen_id > 0 )
    {
    // Get a list of all forums the user has permissions to read
    $auth_f_read = array_keys($auth->acl_getf('f_read', true));

        if( $type == 'topic_id' )
        {
            $sql     = 'SELECT topic_id FROM ' . TOPICS_TABLE . '
                        WHERE ' .  $db->sql_in_set('topic_id', $gen_id) . '
                        AND ' .  $db->sql_in_set('forum_id', $auth_f_read);

            $result     = $db->sql_query($sql);

                while( $row = $db->sql_fetchrow($result) )
                {
                        // Create an array with all acceptable topic ids
                        $topic_id_list[] = $row['topic_id'];
                }

            unset($gen_id);

            $gen_id = $topic_id_list;
            $size_gen_id = sizeof($gen_id);
        }

    $j = 0;    

        for( $i = 0; $i < $size_gen_id; $i++ )
        {
        $id_check = (int) $gen_id[$i];

            // If the type is topic, all checks have been made and the query can start to be built
            if( $type == 'topic_id' )
            {
                $out_where .= ($j == 0) ? 'WHERE ' . $type . ' = ' . $id_check . ' ' : 'OR ' . $type . ' = ' . $id_check . ' ';
            }

            // If the type is forum, do the check to make sure the user has read permissions
            else if( $type == 'forum_id' && $auth->acl_get('f_read', $id_check) )
            {
                $out_where .= ($j == 0) ? 'WHERE ' . $type . ' = ' . $id_check . ' ' : 'OR ' . $type . ' = ' . $id_check . ' ';
            }    

        $j++;
        }
    }

    if( $out_where == '' && $size_gen_id > 0 )
    {
        trigger_error('A list of topics/forums has not been created');
    }

    return $out_where;
}

$search_limit = 5;

    $forum_id = array(2);
    $forum_id_where = create_where_clauses($forum_id, 'forum');

    $topic_id = array(1);
    $topic_id_where = create_where_clauses($topic_id, 'topic');



page_header('Home');

$template->set_filenames(array(
    'body' => 'home.html',
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

?>