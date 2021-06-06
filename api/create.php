<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');

	include_once('../core/init.php');

    use Model\Posts as post;
    use Controller\Database as DB;

    $post = post::load();

    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    if ($post->create()->feedback) 
        echo json_encode(['message' => 'Post Created.']);
    else echo json_encode(['message' => 'Post not created.']);