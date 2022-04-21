<?php
    if(!empty($this->sliderItems)){
        $xhtmlSlider = '';
        foreach($this->sliderItems as $slider){
            $linkSlider         = $slider['link'];
            $name               = $slider['name'];
            $picture = HelperFrontend::createImage('slider', $slider['picture'], ['class' => 'img-fluid blur-up lazyload bg-img']);

            $xhtmlSlider .= '<div><a href="'.$linkSlider.'" class="home text-center">'.$picture.'</a></div>';
        }
    }
?>
<section class="p-0 my-home-slider">
    <div class="slide-1 home-slider">
        <?php echo $xhtmlSlider; ?>
    </div>
</section>