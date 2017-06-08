<?php
  $url = ltrim ($_SERVER['REQUEST_URI'],'/');
  $oldurls = array(
    "portfolio.aspx"=>"/portfolio/",
    "project.aspx?id=48"=>"/project/the-brick-presbyterian-church-watson-hall-renovation/",
    "project.aspx?id=43"=>"/project/the-visionaire-penthouse-and-terrace/",
    "project.aspx?id=46"=>"/project/ny-distilling-co/",
    "project.aspx?id=45"=>"/project/cannacord-genuity/",
    
    "project.aspx?id=2"=>"/project/coldwell-banker-commercial",
    "project.aspx?id=3"=>"/project/greenburgh-nature-center",
    "project.aspx?id=40"=>"/project/greenburgh-nature-center",
    "project.aspx?id=4"=>"/project/brooklyn-brewery",
    
    "project.aspx?id=42"=>"/project/brooklyn-brewery",
    "project.aspx?id=1"=>"/project/the-gallery-of-international-naive-art",
    "project.aspx?id=44"=>"/project/",
    "project.aspx?id=5"=>"/project/",
    
    "project.aspx?id=6"=>"/project/",
    "project.aspx?id=7"=>"/project/the-salvation-army-adult-rehabilitation-center",
    "project.aspx?id=8"=>"/project/radburn-new-jersey",
    "project.aspx?id=9"=>"/project/",
    
    "project.aspx?id=10"=>"/project/",
    "project.aspx?id=11"=>"/project/",
    "project.aspx?id=12"=>"/project/",
    "project.aspx?id=13"=>"/project/",
    
    "project.aspx?id=14"=>"/project/russell-sage-foundation",
    "project.aspx?id=16"=>"/project/",
    "project.aspx?id=19"=>"/project/",
    "project.aspx?id=21"=>"/project/rockefeller-apartments",
    
    "project.aspx?id=22"=>"/project/",
    "project.aspx?id=23"=>"/project/westchester-architect",
    "project.aspx?id=24"=>"/project/",
    "project.aspx?id=25"=>"/project/farmhouse-architecture",
    
    "profile.aspx"=>"/studio/",
    "principals.aspx"=>"/studio/#leadership",
    "services.aspx"=>"/studio/#who-we-are",
    "contact.aspx"=>"/contact/",
  );
  
  if( array_key_exists($url,$oldurls) ) {
    header("Location: ".$oldurls[$url]);
  }
?>
<?php get_header(); ?>
  <section id="search">
    <h2>We're sorry, that page cannot be found.</h2>
  </section>
<?php get_footer(); ?>