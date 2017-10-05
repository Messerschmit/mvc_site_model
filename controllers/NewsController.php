<?php
    include_once ROOT.'/models/News.php';

class NewsController
{
    /*
     * Returns news list
     *
     * */
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();
        require_once (ROOT.'/views/news/index.php');

        return true;
    }

    /*
     * Returns view news with specified parameters
     *
     * @param string $category
     * @param int $category
     *
     * */

    public function actionView($id)
    {
        if ($id){
                $newsItem  = News::getNewsItemById($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';

            echo 'actionView';
        }
        return true;
    }
}