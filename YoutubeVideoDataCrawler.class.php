<?php

class YoutubeVideoDataCrawler {

    private static $video_id;
    private $json;
    private $json_data;

    function __construct($video_id) {
        $this->video_id = $video_id;

        $json = file_get_contents("https://gdata.youtube.com/feeds/api/videos/$video_id?v=2&alt=json");
        $json_data = json_decode($json);

        $this->json = $json;
        $this->json_data = $json_data;
    }

    function views() {
        $views = $this->json_data->{'entry'}->{'yt$statistics'}->{'viewCount'};
        return $views;
    }

    function publishDate() {
        $publish_date = $this->json_data->{'entry'}->{'published'}->{'$t'};
        return $publish_date;
    }

    function title() {
        $title = $this->json_data->entry->title->{'$t'};
        return $title;
    }

    function category() {
        $category = $this->json_data->entry->category[1]->{'label'};
        return $category;
    }

    function author() {
        $author = $this->json_data->entry->author[0]->name->{'$t'};
        return $author;
    }

    function duration() {
        $duration = $this->json_data->entry->{'media$group'}->{'media$content'}[0]->{'duration'};
        return $duration;
    }

    function description() {
        $description = $this->json_data->entry->{'media$group'}->{'media$description'}->{'$t'};
        return $description;
    }

    function likesCount() {
        $likes = $this->json_data->{'entry'}->{'yt$rating'}->{'numLikes'};
        return $likes;
    }

    function disLikesCount() {
        $dislikes = $this->json_data->{'entry'}->{'yt$rating'}->{'numDislikes'};
        return $dislikes;
    }
    
    function favoriteCount(){
        $favorite = $this->json_data->{'entry'}->{'yt$statistics'}->{'favoriteCount'};
        return $favorite;
    }

    function thumbnails() {
        $thumbnail_counter = 0;
        foreach ($this->json_data->{'entry'}->{'media$group'}->{'media$thumbnail'} as $t) {
            $thumbs[$thumbnail_counter] = $t->{'url'};
            $thumbnail_counter++;
        }
        return $thumbs; //this is an array you can call this function like $obj->thumbnail()[1,2,3...];
    }

}

?>