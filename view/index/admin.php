<?


  if (isAdmin()) {
     
     ?>
     <div class="row">
         <div class="col-6">
               <h3> افزودن دسته جدید</h
             <?       View::renderPartial('/archive/category_form'); ?></div>
         
            <div class="col-6"  style="background:#f5f5f5">
                <h3>افزودن مراسم</h3>
                <?   View::renderPartial('/archive/form'); ?></div>
 
     </div
     
     <hr>
     
       <div class="row" style="background:#f5f5f5">
           
             <h3>افزودن صوت</h3>
               <div class="col-6"> <?    View::renderPartial('/mp3/form'); ?></div>
  
       </div>
      
    
     
      
 <?   }
    
    ?>