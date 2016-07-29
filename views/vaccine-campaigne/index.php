<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<html>
<head>
<style>
    h3 {
    display: block;
    font-size: 1.5em;
    margin-top: 1.83em;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
.navbar {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
}
.navbar-default.transparent {
    background-color: transparent;
}
.slide1, .slide2, .slide3 {
    min-height: 560px;
    background-size: cover;
    background-position: center center;
}
.slide1 {
    background-image: url(http://upic.me/i/yp/s__9986084.jpg);
}
.slide2 {
    background-image: url(http://pr.prd.go.th/phetchabun/images/article/news2000/n20150402124634_27513.jpg);
}
.slide3 {
    background-image: url(<?=Url::base().'/uploads/user_photos/999.jpg' ?>);
}
/* Carousel Fade Effect */
.carousel.carousel-fade .item {
    -webkit-transition: opacity 1s linear;
    -moz-transition: opacity 1s linear;
    -ms-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    transition: opacity 1s linear;
    opacity: .2;
}
.carousel.carousel-fade .active.item {
    opacity: 1;
}
.carousel.carousel-fade .active.left,
.carousel.carousel-fade .active.right {
    left: 0;
    z-index: 2;
    opacity: 0;
    filter: alpha(opacity=0);
}
.carousel-overlay {
    position: absolute;
    bottom: 100px;
    right: 0;
    left: 0;
}

</style>
</head

<body >
<!--navigation bar-->
<nav class="navbar navbar-default transparent navbar-static-top" role="navigation" id="navbar-main">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navCollapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="fa fa-chevron-down"></span> <b>Menu</b>
            </button>
            <a class="navbar-brand" href="#">Your Brand</a>
        </div>
        <div class="collapse navbar-collapse" id="navCollapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Projects</a></li>
                <li><a href="#">Company</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<!--end nav bar-->
<!--begin bg-carousel-->
<div id="bg-fade-carousel" class="carousel slide carousel-fade" data-ride="carousel">
<!-- Wrapper for slides -->
<h3 >โครงการเฉลิมพระเกียรติสมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี</h3>
        <h4>เนื่องในโอกาสทรงเจริญพระชนมายุ 60 พรรษา เพื่อคุ้มครองคนไทยจากโรคร้ายด้วยวัคซีน ปี 2558</h4>
    <div class="carousel-inner">
        <div class="item active">
            <div class="slide1"></div>
        </div>
        <div class="item">
            <div class="slide2"></div>
        </div>
        <div class="item">
            <div class="slide3"></div>
        </div>
    </div><!-- .carousel-inner --> 
    
    <div class="container carousel-overlay text-center">
        <h2></h2>
        <h3></h3>
        <p class="lead"></p>
        <a class="btn btn-lg btn-success fp-buttons" href="index.php?r=vaccine-campaigne/viewdt">
            <span class="fa fa-check"></span> ผลการรณรงค์ให้วัคซีน dT </a>
        <a class="btn btn-lg btn-success fp-buttons" href="index.php?r=vaccine-campaigne/viewmr">
            <span class="fa fa-check"></span> ผลการรณรงค์ให้วัคซีน MR</a>
    </div>
</div><!-- .carousel --> 
<!--end bg-carousel-->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
           <p>ผลการรณรงค์ฯ</p>
        </div><!--/.col -->
    </div><!--/.row -->
</div><!--/.container -->

 <!-- Core JavaScript -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>