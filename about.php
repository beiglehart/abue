<?php
  //starts webpage 
  session_start();



//connects to database
  $database = new PDO('sqlite:../recipes_desc/data.sqlite');

  $sur = $database->query("
  SELECT Recipie_Name 
  from Recipes");
   
  $data = $sur->fetchAll(PDO::FETCH_ASSOC);
   
   
  $seed = count($data);
   
  $surpise_recipie_index = rand(0,$seed);
   
  $surpise_recipie = $data[$surpise_recipie_index]['Recipie_Name'];



    if(isset($_POST['SearchButton'])) {
          
            $_SESSION["SearchPhrase"] = $_POST["SearchBy"];
            header("Location: https://atec.utdallas.app/~bei180001/final-project/recipes_list/recipes_list.php");
        }

  $html = "



<!DOCTYPE html>
<html lang=\"en\">

<head>
  <meta charset = \"utf-8\">
  <title>About</title>
  <meta name = \"author\" content = \"Barbara Iglehart\">
  
  <!-- Icon Library from Font Awesome-->
  <script src=\"https://kit.fontawesome.com/d684629f3b.js\" crossorigin=\"anonymous\"></script>
  
  <!-- links to font library -->
  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
  <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
  <link href=\"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;0,900;1,300;1,500;1,700;1,900&display=swap\" rel=\"stylesheet\">
  <link href=\"https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap\" rel=\"stylesheet\">
  
  <!-- links to CSS file -->
  <link href=\"about.css\" rel=\"stylesheet\">
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
        <a href = \"https://atec.utdallas.app/~bei180001/final-project/recipes_desc/recipes_desc.php?item={$surpise_recipie}\" class = \"topnav_link\">Surprise Me</a>
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
  
  <!-- Main Content Row -->
  <div class = \"flexbox_base\">
    <div class = \"grid_base indented\" id = \"main_grid\">
      
      <div class = \"row main_row\">
        <div class = \"main_txt\">
          <h1>Header</h1>
          <p>This is a placeholder paragraph. It will be about my grandma, and my connection to her and her cooking.</p>
          <p>This is a placeholder paragraph. It will be about me and why I made this website. (I love mexican food and programming)</p>
        </div>
      </div> 
      
      <div class = \"row colors_row\">
        <div class = \"colors_pic\">
          <img src = \"../images/colors.svg\" class = \"colors\">
        </div> 
      </div>
  
    </div>  
  </div>
  
  <!-- Thanks Row -->
  <div class = \"flexbox_base\">
    <div class = \"row indented thanks\">
        <h2>Thanks for visiting!</h2>
    </div>    
  </div>
  
</body>";

  // output the html page
  echo $html;
?>