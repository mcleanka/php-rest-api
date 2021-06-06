<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');

	include_once('../core/init.php');

    use Model\Posts as post;
    use Controller\Database as DB;

    $post = post::load();

    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;
    $post->body = $data->body;
    $post->title = $data->title;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    if ($post->update()->feedback) 
        echo json_encode(['message' => 'Post Updated.']);
    else echo json_encode(['message' => 'Post not updated.']);