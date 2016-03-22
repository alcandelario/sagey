<?php 
namespace Fyda\Sagey; 

global $Fyda_cap;

?>

<style>
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  .container {
    margin-left: 0;
  }
</style>

<div class="wrap admin container">
  
  <h1>The Sagey WP Starter Plugin</h1>

  <h4><?php echo "The plugin  name from the \"options\" page is set to: $Fyda_cap->favorite_name_Fyda"; ?></h4>
</div>
