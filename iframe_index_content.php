<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<!--Css Jquey mobile-->
    <link rel="stylesheet" href="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
    <link rel="stylesheet" href="./assets/css/jqm-demos.css">
    <link rel="stylesheet" href="./font-awesome.css">
    <link rel="stylesheet" href="./css/font-awesome.css">
<!--Css importées-->
    <link rel="stylesheet" href="./portofolio/animate.css">
      <link href="./managerCss/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="./managerCss/mdb.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" media="screen" href="css/app.css"/>
      <!-- Your custom styles (optional) -->
      <link href="managerCss/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/addStyle.css">
    <link rel="stylesheet" href="./css/theme_classic.css">
   <!--Vue.js--> 
  <script src="./vue.js"> </script>
  <script src="./kartable_ajax.js"></script> 
<!--Js Jquery mobile-->
    <script src="./jquery-2.1.1.min.js"></script>
    <script src="./jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script>
$.mobile.document.on( "pagebeforeshow", function(){
  make_sleep();
});
  </script>

<style>
.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: opacity 1s;
}
.fade-leave {

}
.fade-leave-active {
  transition: opacity 1s;
  opacity: 0;
}
.slide-enter {

}
.slide-enter-active {

}
.slide-leave {

}
.slide-leave-active {
  animation: slide-out 1s ease-out forwards;
}
@keyframes slide-in {
  from {
    transform: translateY(20px);
  }
  to {
    transform: translateY(0);

  }
}
@keyframes slide-out {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(20px);

  }
}
img{
  cursor: pointer;
}
</style>
    </head>
<body>
<!-- Full Page Intro -->
 <div class="view" style="margin-top: 2%;" id="Indexcontent" style="background-image: url(./images/students.PNG);background-size: contain;">
    <!-- Mask & flexbox options-->
    <div class="rgba-black-black d-flex justify-content-center align-items-center" style="border-color: black;">
 <div id="cadre" class="card" style="width: 80%;" data-theme="c">
            <!--Card content-->
            <div class="card-body" >
            <div class="card" id="rectangle">

<div class="card-header">
      <!-- Content -->
      <div class="text-center white-text mx-5 wow fadeIn ">
        <h1 class="display-4 mb-2">
          <strong style="color: #fff;font-family: leelawadee;">Outil de gestion intégré
            </strong>
        </h1>
</div> </div> </div>
       <hr>
<div id="app3" >

   <div style="margin-left: 20%;" class="" >

        <span id="time-counter" style="color: black;" title="It's coming soon"></span>
        
      </div>
      <hr>
    <div class="card" id="rectangle">
   <div class="card-header">

   <section v-if="!gameIsRunning">

   <transition 
   appear
   leave-active-class="animated rubberBand"
   >
   <span style="display: inline-flex;">
   <div class="container__element" id="start-game" v-on:click="startGame" style="height: 40px;margin-top: 25px;">
                        <div class="bloque__a back6">
                            <div class="loader__6">
                                     <div class="loader6 small_1"></div>
                                     <div class="loader6 large_1"></div>
                                     <div class="loader6 medieme_1"></div>
                                     <div class="loader6 small"></div>
                                     <div class="loader6 large"></div>
                                     <div class="loader6 medieme"></div>
                            </div>
                        </div>
                </div>    
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <img src="images/Firefox_100px.png" id="heal" v-on:click="heal" alt="" style="height: 40px;margin-top: 20px;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <img src="images/Chrome_color.png" id="attack" v-on:click="attack" alt="" style="height: 40px;margin-top: 20px;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <img src="images/Microsoft_Edge_100px.png" id="heal" v-on:click="heal" alt="" style="height: 40px;margin-top: 20px;">
      
</span>
</transition>

<transition 
appear
leave-active-class="animated swing"
   
>
  <div class="healthbar">
  <div class="healthbar" style="background-color: #3388cc;margin: 0;color: white;" v-bind:style="{width: playerHealth + '%'}">
   &nbsp;&nbsp;   {{  playerHealth  }} % compatible</div>
   </div>
   </transition>
   
  </section>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<section v-else>
<span>
<img src="images/Saturation_100px.png" v-on:click="gameIsRunning = !gameIsRunning" alt="" style="height: 30px;">
      </span> 
<h5 style="margin-left: 60%;margin-top: -2%;color:white;font-size:17px;font-family: leelawadee;">Licence accordée à : Lycée Mama Diankeba <br> StarTech production copyright &copy; 2020</h5>
</section>

</div> </div>
      <!-- Content -->
</div>    </div>    <!-- Mask & flexbox options--> </div>  </div></div>    

<script src="./main.js"></script>
<?php include("jsfiles.html"); ?>

<script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

</body>
 </html>