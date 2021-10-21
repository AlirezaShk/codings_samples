<?php
// +------------------------------------------------------------------------+
// | @author Deen Doughouz (DoughouzForest)
// | @author_url 1: http://www.playtubescript.com
// | @author_url 2: http://codecanyon.net/user/doughouzforest
// | @author_email: wowondersocial@gmail.com   
// +------------------------------------------------------------------------+
// | PlayTube - The Ultimate Video Sharing Platform
// | Copyright (c) 2017 PlayTube. All rights reserved.
// +------------------------------------------------------------------------+



/*if (!IS_LOGGED) {

	$response_data    = array(
	    'api_status'  => '400',
	    'api_version' => $api_version,
	    'errors' => array(
            'error_id' => '1',
            'error_text' => 'Not logged in'
        )
	);
}

else */if ((empty($_POST['media_id']) || empty($_POST['from_user_id']) || empty($_POST['to_user_id']))) {

	$response_data       = array(
        'api_status'     => '400',
        'api_version'    => $api_version,
        'errors'         => array(
            'error_id'   => '2',
            'error_text' => 'Bad Request, Invalid or missing parameter'
        )
    );
}

else{

	if (!empty($_POST['media_id'])) {
	    $mediaId        = PT_Secure($_POST['media_id']);
	    $from      = PT_Secure($_POST['from_user_id']);
	    $to      = PT_Secure($_POST['to_user_id']);
	    $type      = PT_Secure($_POST['type']);
	    $data      = array('status' => 400);
	    $table     = T_SHAREDMEDIA;

	    $type = $type=='article'?1:0;

	    //add to chats
        if ($_POST['from_user_id'] != $_POST['to_user_id'] && !empty($_POST['to_user_id']) && is_numeric($_POST['to_user_id']) && $_POST['to_user_id'] > 0) {

            $new_message = $type==1?'shared_article':'shared_media';
            $id = PT_Secure($_POST['to_user_id']);


            if ($id != $_POST['from_user_id']) {
                $chat_exits = $db->where("user_one", $_POST['from_user_id'])->where("user_two", $id)->getValue(T_CHATS, 'count(*)');
                if (!empty($chat_exits)) {
                    $db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->update(T_CHATS, array('time' => time()));
                    $db->where("user_one", $_POST['from_user_id'])->where("user_two", $id)->update(T_CHATS, array('time' => time()));
                    if ($db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->getValue(T_CHATS, 'count(*)') == 0) {
                        $db->insert(T_CHATS, array('user_two' => $_POST['from_user_id'], 'user_one' => $id,'time' => time()));
                    }
                } else {
                    $db->insert(T_CHATS, array('user_one' => $_POST['from_user_id'], 'user_two' => $id,'time' => time()));
                    if (empty($db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->getValue(T_CHATS, 'count(*)'))) {
                        $db->insert(T_CHATS, array('user_two' => $_POST['from_user_id'], 'user_one' => $id,'time' => time()));
                    }
                }
                $insert_message = array(
                    'from_id' => $_POST['from_user_id'],
                    'to_id' => $id,
                    'text' => $new_message,

                    'time' => time()
                );
//                $insert = $db->insert(T_MESSAGES, $insert_message);
            }
        }
	    //add to chats

        $data_insert   = array(
            'media_id'  => $mediaId,
            'from_user_id' => $from,
            'to_user_id'  => $to,
            'date_insert'=>date('Y-m-d H:i:s'),
            'seen_status'=>0,
            'type'=>$type
        );

        $insert = $db->insert($table,$data_insert);

        //add to chats
        if ($_POST['from_user_id'] != $_POST['to_user_id'] && !empty($_POST['to_user_id']) && is_numeric($_POST['to_user_id']) && $_POST['to_user_id'] > 0) {
            $new_message = $type==1?'shared_article':'shared_media';
            $id = PT_Secure($_POST['to_user_id']);


            if ($id != $_POST['from_user_id']) {
                $chat_exits = $db->where("user_one", $_POST['from_user_id'])->where("user_two", $id)->getValue(T_CHATS, 'count(*)');
                if (!empty($chat_exits)) {
                    $db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->update(T_CHATS, array('time' => time()));
                    $db->where("user_one", $_POST['from_user_id'])->where("user_two", $id)->update(T_CHATS, array('time' => time()));
                    if ($db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->getValue(T_CHATS, 'count(*)') == 0) {
                        $db->insert(T_CHATS, array('user_two' => $_POST['from_user_id'], 'user_one' => $id,'time' => time()));
                    }
                } else {
                    $db->insert(T_CHATS, array('user_one' => $_POST['from_user_id'], 'user_two' => $id,'time' => time()));
                    if (empty($db->where("user_two", $_POST['from_user_id'])->where("user_one", $id)->getValue(T_CHATS, 'count(*)'))) {
                        $db->insert(T_CHATS, array('user_two' => $_POST['from_user_id'], 'user_one' => $id,'time' => time()));
                    }
                }
                $insert_message = array(
                    'from_id' => $_POST['from_user_id'],
                    'to_id' => $id,
                    'text' => $new_message,
                    'media' => $mediaId,
                    'time' => time()
                );
                $insert = $db->insert(T_MESSAGES, $insert_message);
            }
        }
        //add to chats

        if ($insert) {
            $response_data['status'] = 200;
            $response_data['message']   = 'shared successfully';
        }else{
            $response_data       = array(
                'api_status'     => '400',
                'api_version'    => $api_version,
                'errors'         => array(
                    'error_id'   => '2',
                    'error_text' => 'Bad Request, Database error'
                )
            );
        }
    }
}