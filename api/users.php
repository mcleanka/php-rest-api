<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once('../core/init.php');

    use Model\Posts as post;
    use Controller\Database as DB;

    $result = post::load()->users()->sqlObj;

    $num = $result->rowCount();

    if ($num > 0) {
        $post_arr = [];
        $post_arr['data'] = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $post_item = [
              'id' => $id,
              'title' => $title,
              'body' => html_entity_decode($body),
              'author' => $author,
              'category_id' => $category_id,
              'category_name' => $category_name,
            ];

            array_push($post_arr['data'], $post_item);
        }

        echo json_encode($post_arr);
    } else echo json_encode(['message' => 'No post(s) found']);