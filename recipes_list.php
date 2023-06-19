<?php

  //starts webpage 
  session_start();


//connects to database
  $database = new PDO('sqlite:../recipes_desc/data.sqlite');

 if (!empty($_GET)){
    
  $_SESSION["SearchPhrase"] = $_GET["SearchBy"];
    
  }



  $SearchCriterion = $_SESSION["SearchPhrase"];

   
  $result1 = $database->query("
  SELECT Recipie_Name 
  from Recipes");
   
  $data = $result1->fetchAll(PDO::FETCH_ASSOC);
   
   
  $seed = count($data);
   
  $surpise_recipie_index = rand(0,$seed);
   
  $surpise_recipie = $data[$surpise_recipie_index]['Recipie_Name'];

  $result2 = $database->query("
  SELECT Recipie_Name 
  from Recipes 
  WHERE Recipie_Name LIKE '{$SearchCriterion}%' COLLATE NOCASE
  ");
  
  $data = $result2->fetchAll(PDO::FETCH_ASSOC);


  $div_items = '';
  foreach ($data as $character) {
      $div_items .= " <div class = \"col recipe_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_desc/recipes_desc.php?item={$character['Recipie_Name']}\" class = \"recipe_link\"><img src = \"../images/placeholder.jpg\" class = \"recipe_img\"></a>
        <p>{$character['Recipie_Name']}</p>
      </div>";
  }



 if(isset($_GET['quiz'])){
   
   $quiz_choice = $_GET['quiz'];
   
   if ($quiz_choice == 'Pescatarian' or $quiz_choice == 'Vegetarian' or $quiz_choice == 'Vegan'  ) {
     
 
     
  $r = $database->query("
  SELECT Recipie_Name 
  from Recipes 
  WHERE $quiz_choice == 'Yes' ");
  
  $data = $r->fetchAll(PDO::FETCH_ASSOC);


  $div_items = '';
  foreach ($data as $character) {
      $div_items .= " <div class = \"col recipe_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_desc/recipes_desc.php?item={$character['Recipie_Name']}\" class = \"recipe_link\"><img src = \"../images/placeholder.jpg\" class = \"recipe_img\"></a>
        <p>{$character['Recipie_Name']}</p>
      </div>";
  }
     
     
         
   }
   else {
     
     
    $r = $database->query("
  SELECT Recipie_Name 
  from Recipes 
  WHERE $quiz_choice == 'No' ");
  
  $data = $r->fetchAll(PDO::FETCH_ASSOC);


  $div_items = '';
  foreach ($data as $character) {
      $div_items .= " <div class = \"col recipe_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_desc/recipes_desc.php?item={$character['Recipie_Name']}\" class = \"recipe_link\"><img src = \"../images/placeholder.jpg\" class = \"recipe_img\"></a>
        <p>{$character['Recipie_Name']}</p>
      </div>";
  }
     
     
     
     
     
   }
   
    
        
   
   
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
  <link href=\"recipes_list.css\" rel=\"stylesheet\">
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
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?searchby=\" class = \"topnav_link\">Recipes</a>
      </div>

      <div class = \"topnav_col margin\">
        <a href=\"https://atec.utdallas.app/~bei180001/final-project/recipes_desc/recipes_desc.php?item={$surpise_recipie}\" onclick=\"surpriseFunction()\". class = \"topnav_link\">Surprise Me</a>
      </div>

      <div class = \"topnav_col margin\">
        <a href = \"../about/about.php\" class = \"topnav_link\">About</a>
      </div>      

      <div class = \"topnav_col margin\">
        <a href = \"../saved_recipes/saved_recipes.php\" class = \"topnav_link\"><i class=\"fa-solid fa-heart\"></i></a>
      </div>
      
      <form>
      <div class = \"row searchbar\">
        <button type=\"submit\" name=\"SearchButton\"><i class=\"fa-solid fa-magnifying-glass\"></i></button>
        <input type = \"text\" class = \"search\" name=\"SearchBy\"></input>
      </div>       
      <form> 

    </div>   
  </div>
  
  <!-- Quiz Options Row -->
  <div class = \"flexbox_base\">
    <div class = \"row indented quiz_row\">

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Pescatarian\"><i class=\"fa-solid fa-fish\"></i></a>
        <p>Pescatarian</p>
      </div>

      <div class = \"col quiz_col\">
        <a  href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Vegetarian\"><i class=\"fa-solid fa-seedling\"></i></a>
        <p>Vegetarian</p>
      </div>

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Vegan\"><i class=\"fa-solid fa-carrot\"></i></a>
        <p>Vegan</p>
      </div>

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Gluten\"><span class = \"fa-stack\">
          <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
          <i class=\"fa-solid fa-wheat-awn fa-stack-1x\"></i>
        </span></a>       
        <p>No Gluten</p>
      </div>

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Beef\"><span class = \"fa-stack\">
          <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
          <i class=\"fa-solid fa-cow fa-stack-1x\"></i>
        </span></a>
        <p>No Beef</p>
      </div> 

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Pork\"><span class = \"fa-stack\">
          <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
          <i class=\"fa-solid fa-bacon fa-stack-1x\"></i>
        </span></a>
        <p>No Pork</p>
      </div>

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Eggs\"><span class = \"fa-stack\">
          <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
          <i class=\"fa-solid fa-egg fa-stack-1x\"></i>
        </span></a>
        <p>No Eggs</p>
      </div>

      <div class = \"col quiz_col\">
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php?quiz=Dairy\"><span class = \"fa-stack\">
          <i class=\"fa-solid fa-ban fa-stack-2x\"></i>
          <i class=\"fa-solid fa-cheese fa-stack-1x\"></i>
        </span></a>
        <p>No Dairy</p>
      </div>
      
    </div>    
  </div>
  
  <!-- Navigation Bar Row -->
  <div class = \"flexbox_base\">
    <div class = \"row indented recipe_row\">
      
     {$div_items}
      
    </div>
  </div>
  
</body>";

  // output the html page
  echo $html;
?>  