<?php
use PixieHuge\Controller;
use PixieHuge\Stream;

class pixiehugestreamsController extends Controller
{

    public function index($tables) {

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'General Settings'],
            ['id' => 'streamintegration', 'name' => 'Stream integration'],
            ['id' => 'streams', 'name' => 'Streams'],
            ['id' => 'add', 'name' => 'Add stream'],
        ];

        // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'add') {
                $saveInfo = $this->save($tables, true);
            } elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'mainstream') {
                $saveInfo = $this->save_status($tables, true);
            }
        }
        $data['saveInfo'] = $saveInfo;

	    // Get Streams
        $q = "SELECT * FROM `{$tables['streams']}`";
        $data['streams'] = $this->query($q);

        $this->view('stream/index', $data);

    }

    private function save($tables, $insert = true) {
        global $wpdb;

        $data = [
            'thumbnail'         => stripslashes_deep($_REQUEST['stream_thumbnail']),
            'title'             => stripslashes_deep($_REQUEST['title']),
            'category'          => stripslashes_deep($_REQUEST['category']),
            'link'              => stripslashes_deep($_REQUEST['url']),
            'created_at'        => stripslashes_deep(date('Y-m-d H:i:s', time())),
        ];
        $error = false;
        if(empty($data['link']) || empty($data['thumbnail']) || !in_array($data['category'], ['twitch', 'youtube', 'mixer'])){
            $error = true;
        }

        if(!$error) {
            $stream = new Stream;

            // Get stream information
            if($data['category'] == 'twitch') {

                if (!strpos($data['link'], 'twitch.tv/')) {
                    return esc_html__('Wrong twitch URL', 'pixiehugepanel');
                }
                $channelName = $stream->parseStreamURI($data['link']);
                $channelData = json_decode($stream->getStream($channelName, 'twitch', get_option('pixiehuge-twitch-clientid')), 1);

                $data['preview'] = $channelData['profile_banner'];
                $data['author'] = $channelData['display_name'];
            } elseif($data['category'] == 'youtube') {
                if (!strpos($data['link'], 'youtube.com/')) {
                    return esc_html__('Wrong youtube URL', 'pixiehugepanel');
                }
	            $apiKey = get_option('pixiehuge-youtube-api-key');
	            $channel = $stream->getYoutubeChannel($data['link'], $apiKey);

	            if(empty($channel)) {
		            return esc_html__('Wrong youtube URL', 'pixiehugepanel');
	            }
	            $data['preview'] = $channel['snippet']->thumbnails->high->url;
                $data['author'] = $channel['snippet']->title;
            } elseif($data['category'] == 'mixer') {
                if (!strpos($data['link'], 'mixer.com/')) {
                    return esc_html__('Wrong mixer URL', 'pixiehugepanel');
                }

	            $channelName = $stream->parseStreamURI($data['link']);
	            $channelData = json_decode($stream->getStream($channelName, 'mixer'), 1);

	            if(empty($channelData)) {
		            return esc_html__('Wrong mixer URL', 'pixiehugepanel');
	            }
	            $data['preview'] = $channelData['cover']['url'];
	            $data['author'] = $channelData['user']['username'];
            }

            // Saving
            if($insert) {
                
                // Insert
                $wpdb->insert( $tables['streams'], $data);
                return esc_html__('Stream added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);
                
                $id = esc_sql($_REQUEST['id']);
                $wpdb->update( $tables['streams'], $data, ['id' => $id]);
                return esc_html__('Stream updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }

    private function save_status($tables, $insert = true) {
        global $wpdb;

        $data = [
            'id'             => esc_sql($_REQUEST['stream_id']),
        ];

        $error = false;
        if(empty($data['id'])){
            $error = true;
        }

        if(!$error) {
            // Update
            $wpdb->update( $tables['streams'], ['status' => 0], ['status' => 1]);
            $wpdb->update( $tables['streams'], ['status' => 1], ['id' => $data['id']]);
            return esc_html__('Main stream updated!', 'pixiehugepanel');
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }

    public function edit($tables) {

        // Save changes
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'update') {
                $saveInfo = $this->save($tables, false);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Other
        $data['menu'][] = [
            'id'    => 'home', // ID
            'name'  => 'Edit stream', // NAME
        ];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiehugestreams', 'error', esc_html__('Stream not found', 'pixiehugepanel'));
            return false;
        }
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['streams']}` WHERE `id`='{$id}'";
        $data['stream'] = $this->query($q);
        
        if(empty($data['stream'])) {
            $this->redirect('pixiehugestreams', 'error', esc_html__('Stream not found', 'pixiehugepanel'));
        }

        return $this->view('stream/edit',$data);
    }

    public function delete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiehugestreams');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['streams'], ['id' => $id]);

        $this->redirect('pixiehugestreams', 'success', esc_html__('You have successfully deleted this stream!', 'pixiehugepanel'));
        return false;

    }

}