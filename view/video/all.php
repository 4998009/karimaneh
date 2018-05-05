
<style>
    .gallery{
            display: flex;
    align-items: flex-start;
    justify-content: center;
    flex-flow: wrap;
    }
    
    .gallery li:hover .caption {
    display: block;
    }
    
    .caption{
            word-break: break-word;
            display:none;
    }
    .gallery li{
        background: #3e3e43;
    }
    .gallery video {
    width: 100%;
 
}

</style>
    <div class="gallery"><?
foreach($data as $item){
   // var_dump($item);
    if (strpos($item->videoUrl, '.mp4') !== false) { ?>

    
    
            <li class="col-6 col-sm-6">
                
                <video width="320" height="240" controls preload="none">
  <source src="<?=$item->videoUrl;?>" type="video/mp4">
</video>

           <div>
               <?=$item->caption;?>
           </div>
                </li>
 <?}
}
?>


</div>