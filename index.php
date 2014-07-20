<html>
    <head>
        <title>Hello :)</title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
        require_once 'YoutubeVideoDataCrawler.class.php';
        $video_id = $_GET["v"];

        if (isset($video_id)) {
          //create a new object
          //give a youtube video id to constructor as parameter
          $youtube = new YoutubeVideoDataCrawler($video_id);
            
          //and enjoy
          echo "Title:" . $youtube->title() . "<br>";
          echo "views:" . $youtube->views() . "<br>";
          echo "Publish Date:" . $youtube->publishDate() . "<br>";
          echo "Category:" . $youtube->category() . "<br>";
          echo "Author:" . $youtube->author() . "<br>";
          echo "Duration:" . $youtube->duration() . "<br>";
          echo "Description:" . $youtube->description() . "<br>";
          echo "Likes:" . $youtube->likesCount() . " and Dislikes:" . $youtube->disLikesCount() . "<br>";
          echo "Thumb:".$youtube->thumbnails()[0]."<br>";
          echo "Favorite:".$youtube->favoriteCount()."<br>";
          echo "Thumb Count:".$youtube->thumbnailsCount();
             
        }
        ?>

    </body>
</html>


