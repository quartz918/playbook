<?php
/**
 * Displays page numbers with links to display search results
 * @param type $disp_num number of search hits to display per page
 * @param type $search_term
 * @param type $url url to page where search hits of further pages are displayed
 * @param type $func search function
 */
function disp_page_num($disp_num, $search_term, $url, $func, $filter){
   
    $page = 1; // default value for page, if no other page value is
    if(isset($_GET['page'])){
        $page = e($_GET['page']);
    }
    
    $search_term = e($search_term);
    $offset = ($page -1) * $disp_num;
    if(!empty($func($disp_num, $search_term, $disp_num))){
        if($page >= 2){
            echo "<a href='".$url."?page=".($page-1)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>back </a>";
        }
        
        for($i = 3; $i > 0; $i--){
            $offset = ($page - $i-1) * $disp_num;
            if((($offset)>= 0)) {
                if(!empty($func($offset, $search_term, $disp_num))){
                    echo "<a href='".$url."?page=".($page-$i)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".($page-$i)." </a>";
                }
            }
        }

        echo "<a class='act-ind' href='".$url."?page=".$page."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".$page." </a> ";

        for($i = 1; $i < 4; $i++){
            $offset = ($page + $i-1) * $disp_num;
            if(!empty($func($offset, $search_term, $disp_num))){
                echo "<a href='".$url."?page=".($page+$i)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".($page+$i)." </a>";
            }
        }
        if(!empty($func($page * $disp_num, $search_term, $disp_num))){
            echo "<a href='".$url."?page=".($page+1)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>next</a>";
        } 
    }
}

function disp_page_num_bands($disp_num, $search_term, $url, $func, $filter){
   
    $page = 1; // default value for page, if no other page value is
    if(isset($_GET['page'])){
        $page = e($_GET['page']);
    }
    
    $search_term = e($search_term);
    $offset = ($page -1) * $disp_num;
    if(!empty($func($disp_num, $search_term, $disp_num,"a"))){
        if($page >= 2){
            echo "<a href='".$url."?page=".($page-1)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>back </a>";
        }
        
        for($i = 3; $i > 0; $i--){
            $offset = ($page - $i-1) * $disp_num;
            if((($offset)>= 0)) {
                if(!empty($func($offset, $search_term, $disp_num,"a"))){
                    echo "<a href='".$url."?page=".($page-$i)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".($page-$i)." </a>";
                }
            }
        }

        echo "<a class='act-ind' href='".$url."?page=".$page."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".$page." </a> ";

        for($i = 1; $i < 4; $i++){
            $offset = ($page + $i-1) * $disp_num;
            if(!empty($func($offset, $search_term, $disp_num,"a"))){
                echo "<a href='".$url."?page=".($page+$i)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>".($page+$i)." </a>";
            }
        }
        if(!empty($func($page * $disp_num, $search_term, $disp_num,"a"))){
            echo "<a href='".$url."?page=".($page+1)."&search_query=".$search_term."&submit=Go"."&filter=".$filter."'>next</a>";
        } 
    }
}
?>

