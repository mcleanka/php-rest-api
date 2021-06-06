<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../core/init.php');

    use Model\Posts as post;
    use Controller\Database as DB;

    $post = post::load();
    $post->id = $_GET['id']??die(json_encode(['message' => 'Invalid params supplied.']));
    
    $user = $post->user();

    if($user->row) {
        $post_arr = [
            'id' => $row->id,
            'title' => $row->title,
            'body' => html_entity_decode($row->body),
            'author' => $row->author,
            'category_id' => $row->category_id,
            'category_name' => $row->category_name,    
        ];
        echo json_encode($post_arr);
    } else echo json_encode(["message" => "No such user"]);