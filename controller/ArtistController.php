<?php

class ArtistController
{

    public function index($id)
    {
    }

  
    
    public function id($id,$pageIndex = null){
                if(isset($id)){
            
             if($pageIndex == null)
        $pageIndex = 1;
    $count = 8;
    $startIndex = ($pageIndex-1) * $count;
    $data = array();
    
     $data['records'] = Db::getInstance()->query("select  so.id, so.title,
                                        so.length,
                                        so.download_path,
                                        so.like,
                                        so.download_number,
                                        so.download_size,
                                        so.cover_path,
                                        so.thumbnail_path,
                                        so.original_image_path,
                                        so.selected,
                                        a.fullname AS artist,
                                        t.title as type
                                        from `sound` as so
                                        JOIN `type` as t on t.id = so.type
                                        join `artist` as a on a.id = so.artist_id
                                        where a.id = '$id'
                                        order by id desc
                                         LIMIT $startIndex, $count
                                        
        ");
        
        $artist = Db::getInstance()->query("select fullname from artist where id='$id'");
       
  $records = Db::getInstance()->query("SELECT COUNT(*) AS total FROM sound");
    $recordsCount = $records[0]['total'];
 
    $data['id']= $id;
    
    $data['pageCount'] = ceil($recordsCount / 10);
    $data['pageIndex'] = $pageIndex;
 
        $data['artist'] = $artist[0]['fullname'];
        View::Render('/archive/index', $data);

    }
        
    }
    
 


    


}