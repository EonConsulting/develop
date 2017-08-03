<div class="header-breadcrumb">


    <?php
    if(isset($breadcrumbs)){
        while(true){

            $haschild = isset($breadcrumbs['child']);

            if(isset($breadcrumbs['href'])) {

                echo "<span class='header-breadcrumb-parent-title".($haschild ? " hidden-xs" : "")."'>";
                echo "<a href='".$breadcrumbs['href']."'>";
                echo $breadcrumbs['title'];
                echo "</a>";

            } else {
                echo "<span class='header-breadcrumb-page-title".($haschild ? " hidden-xs" : "")."'>";
                echo $breadcrumbs['title'];
            }

            echo "</span>";

            if($haschild){

                echo '<span class="header-breadcrumb-divider hidden-xs"><i class="fa fa-angle-right"></i></span>';

                $breadcrumbs = $breadcrumbs['child'];

            } else {
                   break;
            }
        }
    } else {
        echo "<span class='header-breadcrumb-page-title'>";
        echo 'NB! $breadcrumbs not set';
        echo "</span>";
    }
   ?>



</div>

<div class="header-notifications">



</div>

<div class="header-logo hidden-xs">

    <img src="{{url('/img/headerlogo.gif')}}" alt="">

</div>
