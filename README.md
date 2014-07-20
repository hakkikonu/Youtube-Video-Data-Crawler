Youtube Video Data Crawler
==========================

This PHP class collects Youtube video data clearly and without headache

Author        : Hakkı Konu <hakkikonu[at sign]gmail.com> ,

Twitter       : @hakkikonu , 

Github        : https://github.com/hakkikonu/ ,

LinkedIn      : https://www.linkedin.com/profile/view?id=66225869 ,


Avaiable Data
- Total view count
- Publish date of video
- Thumbnails and total thumbnail count
- Favorite count
- Like count
- Dislike count
- Video description
- Video duration
- Video publisher
- Youtube category of video
- Video Title

#### How to use?
1)
```php

//Before use class include it to in your file
require_once 'YoutubeVideoDataCrawler.class.php';


//our video is http://www.youtube.com/watch?v=hUYzQaCCt2o
//so video id is hUYzQaCCt2o

$video_id = "hUYzQaCCt2o";

//create a new object
//give a youtube video id to constructor as parameter
$PinkFloyd = new YoutubeVideoDataCrawler($video_id);

//and enjoy
echo "Title:" . $PinkFloyd->title() . "<br>";
echo "views:" . $PinkFloyd->views() . "<br>";
echo "Publish Date:" . $PinkFloyd->publishDate() . "<br>";
echo "Category:" . $PinkFloyd->category() . "<br>";
echo "Author:" . $PinkFloyd->author() . "<br>";
echo "Duration:" . $PinkFloyd->duration() . "<br>";
echo "Description:" . $PinkFloyd->description() . "<br>";
echo "Likes:" . $PinkFloyd->likesCount() . " and Dislikes:" . $youtube->disLikesCount() . "<br>";
echo "Thumb:".$PinkFloyd->thumbnails()[0]."<br>"; //as index you can use 0 to less than thumbnailsCount()
echo "Favorite:".$PinkFloyd->favoriteCount()."<br>";
echo "Thumb count:".$PinkFloyd->thumbnailsCount();

```

