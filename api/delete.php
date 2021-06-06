<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');

	include_once('../core/init.php');

    use Model\Posts as post;
    use Controller\Database as DB;

    $post = post::load();

    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;

    if ($post->delete()->feedback) 
        echo json_encode(['message' => 'Post deleted.']);
    else echo json_encode(['message' => 'Post not deleted.']);