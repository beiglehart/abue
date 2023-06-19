<?php
  //starts webpage 
  session_start();

  $recipeitem = $_GET['item'];

   
  $database = new PDO('sqlite:data.sqlite');


  $sur = $database->query("
  SELECT Recipie_Name 
  from Recipes");
   
  $data = $sur->fetchAll(PDO::FETCH_ASSOC);
   
   
  $seed = count($data);
   
  $surpise_recipie_index = rand(0,$seed);
   
  $surpise_recipie = $data[$surpise_recipie_index]['Recipie_Name'];




 if(isset($_GET['likeitem'])){
   
   $liked_recipie = $_GET['likeitem'];
     
   
 $database->query("INSERT INTO `Liked Recipie` values ('{$liked_recipie}') ");
   
   
 $database->query("INSERT INTO `Shopping List` 
 SELECT Ingredient,Amount from '{$liked_recipie}'
 
 ");
        
      
   
   
 }



  $result = $database->query("
     SELECT Amount, Ingredient 
     from '{$recipeitem}'
  ");

  $data = $result->fetchAll(PDO::FETCH_ASSOC);

  $list_items = '';
  foreach ($data as $character) {
      $list_items .= "<li>  {$character['Ingredient']} &nbsp ({$character['Amount']})  </li>";
  }


    if(isset($_POST['SearchButton'])) {
          
            $_SESSION["SearchPhrase"] = $_POST["SearchBy"];
            header("Location: recipes_list.php");
        }
  //html required to display webpage and table
  $html = "

<!DOCTYPE html>
<html lang=\"en\">

<head>
  <meta charset = \"utf-8\">
  <title>Recipes</title>
  <meta name = \"author\" content = \"Barbara Iglehart\">
  
  <!-- Icon Library from Font Awesome-->
  <script src=\"https://kit.fontawesome.com/d684629f3b.js\" crossorigin=\"anonymous\"></script>
  
  <!-- links to font library -->
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
  <link href=\"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;0,900;1,300;1,500;1,700;1,900&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap\" rel=\"stylesheet\">
  
  <!-- links to CSS file -->
  <link href=\"recipes_desc.css\" rel=\"stylesheet\">
</head>
  
<body>


  <!-- Navigation Bar Row -->
  <div class = \"grid_base\" id = \"topnav_grid\">
    
    <div class = \"row logo_row\">
      <div class = \"logo_pic\">
        <a href = \"../index.php\" class = \"topnav_link\"><img src = \"../images/logo.svg\" class = \"sun\"></a>
      </div>      
     </div>      

    <div class = \"row topnav_row\">

      <div class = \"topnav_col margin\">
        <a href = \"../recipes_list/recipes_list.php\" class = \"topnav_link\">Recipes</a>
      </div>

      <div class = \"topnav_col margin\">
        <a href = \"recipes_desc.php?item={$surpise_recipie}\" class = \"topnav_link\">Surprise Me</a>
      </div>

      <div class = \"topnav_col margin\">
        <a href = \"../about/about.php\" class = \"topnav_link\">About</a>
      </div>      

      <div class = \"topnav_col margin\">
        <a href = \"../saved_recipes/saved_recipes.php\" class = \"topnav_link\"><i class=\"fa-solid fa-heart\"></i></a>
      </div>

      <form method=\"post\">
      <div class = \"row searchbar\">
        <button type=\"submit\" name=\"SearchButton\"><i class=\"fa-solid fa-magnifying-glass\"></i></button>
        <input type = \"text\" class = \"search\" name=\"SearchBy\"></input>
      </div>       
      <form>       

    </div>   
  </div>
  
  <div class = \"flexbox_base\">
    <div class = \"row indented desc_row\">
      
      <div class = \"col\">
        
        <div class = \"row\">
          <h1>{$recipeitem}</h1>
        </div>
        
        <div class = \"row tag_row\">
          <i class=\"fa-solid fa-fish\"></i>
          <i class=\"fa-solid fa-seedling\"></i>
          <span class = \"fa-stack\">
            <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
            <i class=\"fa-solid fa-wheat-awn fa-stack-1x\"></i>
          </span>
        </div>
        
        <div class = \"row favorite_row\">
          <h2>Ingredients</h2>
          <a href = \"recipes_desc.php?likeitem={$recipeitem}&item={$recipeitem}\"><i class=\"fa-solid fa-heart favorite\"></i></a> 
        </div>
        
        <div class = \"row\">
          <ul>
    
            {$list_items}
          </ul>
        </div>
        
      </div>
      
      <div class = \"col\">
        <img src = \"../images/placeholder.jpg\" class = \"desc_img\">  
      </div>
      
    </div>
  </div>
  
</body>";

  // output the html page
  echo $html;
?>