<?php


function disp_search_res_all($num_disp_hits, $search_term, $filter_band){
    if(isset($_GET['submit'])){
        $url="disp_search.php?search_query=".$search_term."&submit=Go";
        $page = 1; // default value for page, if no other page value is

        if(isset($_GET['page'])){
            $page = e($_GET['page']);
        }
        $offset = ($page-1) * $num_disp_hits;
        echo "<div>";
        echo "<p>People: </p>";
        $res = search_for_user($offset, $search_term, $num_disp_hits);
        display_list_users($res);
        echo "<a href=".$url."&filter=people>Show more:</a>";
        echo "</div>";
        echo "<div>";
        echo "<p>Bands: </p>";
        $res = search_for_band($offset, $search_term, $num_disp_hits, $filter_band);

        display_list_bands($res);
        echo "<a href=".$url."&filter=bands>Show more:</a>";
        echo "</div>";
    }
}

function disp_search_res_people($num_disp_hits, $search_term){
 
    if(isset($_GET['submit'])){

        $page = 1; // default value for page, if no other page value is

        if(isset($_GET['page'])){
            $page = e($_GET['page']);
        }
        $offset = ($page-1) * $num_disp_hits;
        $res = search_for_user($offset, $search_term, $num_disp_hits);
        display_list_users($res);   

       
    }
}
/**
 * 
 * @param type $num_disp_hits
 * @param type $search_term
 * @param type $filter: "a" search for active bands, "i" search for inactive, "c" search for all bands
 */

function disp_search_res_bands($num_disp_hits, $search_term, $filter){

    if(isset($_GET['search_go']) OR isset($_GET['submit'])){

        $page = 1; // default value for page, if no other page value is

        if(isset($_GET['page'])){
            $page = e($_GET['page']);
        }
        $offset = ($page-1) * $num_disp_hits;
        include_once("../backend/bands.php");
        include_once("../backend/functions.php");
        include_once("content/disp_list_bands.php");
        
        $res = search_for_band($offset, e($search_term), $num_disp_hits, $filter);

        display_list_bands($res);
    }
}