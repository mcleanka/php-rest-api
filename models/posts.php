<?php
    namespace Model;
    use \Controller\Database as DB;

    class Posts{
        private $table = 'posts';
        public static function load() : object {
            return new self;
        }

        public function users() : object {
            $table = $this->table;

            $query = "SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.body,
                p.author,
                p.create_at
                FROM
                $table p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                ORDER BY p.create_at DESC  
            ";

            return DB::load()->query($query);
        }

        public function user() : object {
            $table = $this->table;

            $query = "SELECT 
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.body,
                p.author,
                p.create_at
                FROM
                $table p
                LEFT JOIN
                    categories c ON p.category_id = c.id
                WHERE p.id =:id LIMIT 1; 
            ";

            return DB::load()->bind([
                'id' => $this->id,
            ])->query($query)
            ->single();
        }

        public function create() : object {
            $table = $this->table;
            $params = [
                'title' => $this->title,
                'body' => $this->body,
                'author' => $this->author,
                'category_id' => $this->category_id,
            ];

            $query = "INSERT INTO $table SET title=:title, body=:body, author=:author, category_id=:category_id";
            return DB::load()->bind($params)->query($query);
        }

        public function update() : object {
            $table = $this->table;
            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'body' => $this->body,
                'author' => $this->author,
                'category_id' => $this->category_id,
            ];

            $query = "UPDATE $table SET title=:title, body=:body, author=:author, category_id=:category_id WHERE id=:id;";
            return DB::load()->bind($params)->query($query);
        }

        public function delete() : object {
            $table = $this->table;
            $query = "DELETE from $table where id=:id";
            
            $params = [
                'id' => $this->id,
            ];
            return DB::load()->bind($params)->query($query);
        }
    }