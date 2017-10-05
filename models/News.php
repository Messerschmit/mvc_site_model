<?php

class News
{
    /*
     * Rerurns single news item with specified id
     *@param integer @id
     * */
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        if ($id){

            try{
                $db = DB::getConnection();
            }catch (PDOException $e){
                echo $e->getMessage();
            }

            $result = $db->query('SELECT * FROM news WHERE id =' . $id) or die ("Error DB Connect!");
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $newsItem = $result->fetch();

            return $newsItem;
        }
    }


    /*
     * Returns an array of news items
     *
     * */
    public static function getNewsList(){

        try {
            $db = DB::getConnection();

        }catch (PDOException $e){

            echo $e->getMessage();
        }

        $newsList = array();

        $result = $db->query('SELECT * FROM news');

        $i = 0;

        while($row = $result->fetch()){
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }
}