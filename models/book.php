<?php

class Book extends Model {

    public function getList($only_published = false){
        $sql = "select * from books where 1";
        if ($only_published){
            $sql .= 'is_published = 1';

        }
        return $this->db->query($sql);
    }

    public function getByAlias($alias){
        $alias = $this->db->escape($alias);
        $sql = "select * from books where alias = '{$alias}' limit 1 ";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0]: null;
    }

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from books where id = '{$id}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0]: null;
    }

    public function save($data ,$id = null){
        if (!isset($data['alias']) || !isset($data['title']) || !isset($data['description'])){
            return false;
        }
        $id = (int)$id;
        $alias = $this->db->escape($data['alias']);
        $title = $this->db->escape($data['title']);
        $author = $this->db->escape($data['author']);
        $description = $this->db->escape($data['description']);
        //$created = $this->db->escape($data[date('Y-m-d H:i')]);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if (!$id){ // Add new record
            $sql = "
                insert into books
                  set alias = '{$alias}',
                    title = '{$title}',
                        author = '{$author}',
                            description = '{$description}',
                                
                            is_published = {$is_published}
            ";
        }else{ // Update existing record
            $sql = "
                update books
                  set alias = '{$alias}',
                    title = '{$title}',
                        author = '{$author}',
                            description = '{$description}',
                                
                            is_published = {$is_published}
                  WHERE id = {$id}
            ";
        }
        return $this->db->query($sql);
    }
    public function delete($id){
        $id = (int)$id;
        $sql = "delete from books where id = {$id}";
        return $this->db->query($sql);
    }
}