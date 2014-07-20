<?php

/**
 * This class collects Youtube video data clearly and without headache
 * 
 * @author      : Hakkı Konu <hakkikonu[at sign]gmail.com>  
 * Twitter      : @hakkikonu
 * Github       : https://github.com/hakkikonu/
 * LinkedIn     : https://www.linkedin.com/profile/view?id=66225869
 * 
 * @version     : 1.1
 * Last Edit    : 20/07/2014
 * 
 */
class YoutubeVideoDataCrawler {

    //http://www.youtube.com/watch?v=XXXX in this url XXXX is our video id
    private static $videoId;
    //When we get contents from Youtube gdata response we'll assign this json to below 
    private $json;
    //$jsonData holds decoded json response.
    private $jsonData;

    /**
     * Constructor function, it gets only one string value as parameter.
     * This parameter must valid Youtube video id
     * @since 1.0
     * @param string $videoId
     */
    function __construct($videoId) {
        $this->videoId = $videoId;

        $json = file_get_contents("https://gdata.youtube.com/feeds/api/videos/$videoId?v=2&alt=json");
        $json_data = json_decode($json);

        $this->json = $json;
        $this->jsonData = $json_data;
    }

    /**
     * Total view count
     * @param no params
     * @return int
     */
    function views() {
        $views = $this->jsonData->{'entry'}->{'yt$statistics'}->{'viewCount'};
        return (int) $views;
    }

    /*     * Publish date
     * @param no param
     * @return date time
     */

    function publishDate() {
        $publish_date = $this->jsonData->{'entry'}->{'published'}->{'$t'};
        return $publish_date;
    }

    /**
     * Title
     * @param no param
     * @return string
     */
    function title() {
        $title = $this->jsonData->entry->title->{'$t'};
        return $title;
    }

    /**
     * Youtube category of video. Sucs as music, education etc.
     * @param no param
     * @return string
     */
    function category() {
        $category = $this->jsonData->entry->category[1]->{'label'};
        return $category;
    }

    /**
     * Who published
     * @param no param
     * @return string
     */
    function author() {
        $author = $this->jsonData->entry->author[0]->name->{'$t'};
        return $author;
    }

    /**
     * Length of video in secs
     * @param no param
     * @return int
     */
    function duration() {
        $duration = $this->jsonData->entry->{'media$group'}->{'media$content'}[0]->{'duration'};
        return (int) $duration;
    }

    /**
     * If publisher fills this section it returns some description
     * about video
     * @param no param
     * @return string
     */
    function description() {
        $description = $this->jsonData->entry->{'media$group'}->{'media$description'}->{'$t'};
        return $description;
    }

    /**
     * How many likes for this video?
     * @param no param
     * @return int
     */
    function likesCount() {
        $likes = $this->jsonData->{'entry'}->{'yt$rating'}->{'numLikes'};
        return (int) $likes;
    }

    /**
     * How many dislikes for this video?
     * @param no param
     * @return int
     */
    function disLikesCount() {
        $dislikes = $this->jsonData->{'entry'}->{'yt$rating'}->{'numDislikes'};
        return (int) $dislikes;
    }

    /**
     * How many user add to their favorites this video?
     * @param no param
     * @return int
     */
    function favoriteCount() {
        $favorite = $this->jsonData->{'entry'}->{'yt$statistics'}->{'favoriteCount'};
        return (int) $favorite;
    }

    /**
     * This function catchs all possible thumbnails, 
     * you can combine this function with thumbnailsCount() to prevent overflow index situation 
     * @example thumbnails()[rand(0, thumbnailsCount()-1)] : on example user get a video thumbnail randomly. As index selected random thumbnail
     * @param no param
     * @return string[] array
     */
    function thumbnails() {
        $c = 0;
        foreach ($this->jsonData->{'entry'}->{'media$group'}->{'media$thumbnail'} as $t) {
            $thumbs[$c] = $t->{'url'};
            $c++;
        }
        return $thumbs; //this is an array you can call this function like $obj->thumbnail()[1,2,3...];
    }

    /**
     * How many thumbnails are there for the video?
     * @param no param
     * @return int
     */
    function thumbnailsCount() {
        $counter = 0;
        foreach ($this->jsonData->{'entry'}->{'media$group'}->{'media$thumbnail'} as $t) {
            $counter++;
        }
        return $counter;
    }

}//end 

?>