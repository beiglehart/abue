<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset = "utf-8">
  <title>Abue</title>
  <meta name = "author" content = "Barbara Iglehart">
  
  <!-- Icon Library from Font Awesome-->
  <script src="https://kit.fontawesome.com/d684629f3b.js" crossorigin="anonymous"></script>
  
  <!-- links to font library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;0,900;1,300;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
  
  <!-- links to CSS file -->
  <link href="homepage.css" rel="stylesheet">
</head>
  
<body>
  
  <!-- Navigation Bar Row -->
   <div class = "grid_base" id = "topnav_grid">
    
    <div class = "row logo_row">
      <div class = "logo_pic">
        <img src = "images/logo.svg" class = "sun">
      </div>      
     </div>    
     
     
     <?php
     $database = new PDO('sqlite:recipes_desc/data.sqlite');
    $sur = $database->query("
  SELECT Recipie_Name 
  from Recipes");
   
  $data = $sur->fetchAll(PDO::FETCH_ASSOC);
   
   
  $seed = count($data);
   
  $surpise_recipie_index = rand(0,$seed);
   
  $surpise_recipie = $data[$surpise_recipie_index]['Recipie_Name'];
     
     ?>

    <div class = "row topnav_row">

      <div class = "topnav_col margin">
        <a href = "recipes_list/recipes_list.php" class = "topnav_link">Recipes</a>
      </div>

      <div class = "topnav_col margin">
        <?php
        
        
        echo "<a href = \"recipes_desc.php?item={$surpise_recipie}\" class = \"topnav_link\">Surprise Me</a>";
        
        
        
        ?>
      </div>

      <div class = "topnav_col margin">
        <a href = "about/about.php" class = "topnav_link">About</a>
      </div>      

      <div class = "topnav_col margin">
        <a href = "saved_recipes/saved_recipes.php" class = "topnav_link"><i class="fa-solid fa-heart"></i></a>
      </div>
      
      <?php
      
      
      if(isset($_POST['SearchButton'])) {
            session_start();
            $_SESSION["SearchPhrase"] = $_POST["SearchBy"];
            header("Location: recipes_list.php");
        }
      
      ?>

      <form method="post">
      <div class = "row searchbar">
        <button type="submit" name="SearchButton"><i class="fa-solid fa-magnifying-glass"></i></button>
        <input type = "text" class = "search" name="SearchBy"></input>
      </div>       
      <form>
        
    </div>   
  </div>   
  
  <!-- Main Content Row -->
  <div class = "flexbox_base">
    <div class = "grid_base indented" id = "main_grid">
      
      <div class = "row main_row">
        <div class = "main_txt">
          <h1>Header</h1>
          <p>This is a placeholder paragraph. It will be a brief intro to my grandma and the purpose of the website.</p>
        </div>
      </div> 
      
      <div class = "row colors_row">
        <div class = "colors_pic">
          <img src = "images/colors.svg" class = "colors">
        </div> 
      </div>
  
    </div>  
  </div>
  
  <!-- Quiz Question Row -->
  <div class = "flexbox_base">
    <div class = "row indented">
      <div class = "main_txt">
        <h2>What kind of recipes are you looking for?</h2>
      </div>
    </div>    
  </div>
  
  <!-- Quiz Options Row -->
  <div class = "flexbox_base">
    <div class = "row indented quiz_row">

      <div class = "col">
        <a href = "recipes_list.php?quiz=Pescatarian"><i class="fa-solid fa-fish"></i></a>
        <p>Pescatarian</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Vegetarian"><i class="fa-solid fa-seedling"></i></a>
        <p>Vegetarian</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Vegan"><i class="fa-solid fa-carrot"></i></a>
        <p>Vegan</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Gluten"><span class = "fa-stack">
          <i class="fa-solid fa-ban fa-stack-2x"></i>
          <i class="fa-solid fa-wheat-awn fa-stack-1x"></i>
        </span></a>       
        <p>No Gluten</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Beef"><span class = "fa-stack">
          <i class="fa-solid fa-ban fa-stack-2x"></i>
          <i class="fa-solid fa-cow fa-stack-1x"></i>
        </span></a>
        <p>No Beef</p>
      </div> 

      <div class = "col">
        <a href = "recipes_list.php?quiz=Pork"><span class = "fa-stack">
          <i class="fa-solid fa-ban fa-stack-2x"></i>
          <i class="fa-solid fa-bacon fa-stack-1x"></i>
        </span></a>
        <p>No Pork</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Eggs"><span class = "fa-stack">
          <i class="fa-solid fa-ban fa-stack-2x"></i>
          <i class="fa-solid fa-egg fa-stack-1x"></i>
        </span></a>
        <p>No Eggs</p>
      </div>

      <div class = "col">
        <a href = "recipes_list.php?quiz=Dairy"><span class = "fa-stack">
          <i class="fa-solid fa-ban fa-stack-2x"></i>
          <i class="fa-solid fa-cheese fa-stack-1x"></i>
        </span></a>
        <p>No Dairy</p>
      </div>
      
    </div>    
  </div>
  
</body>


  