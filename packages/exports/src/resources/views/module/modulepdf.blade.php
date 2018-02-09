<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="" />
</head>
<body>
<style>

    .flex-container {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        /*-webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;*/

    }

    .flex-menu {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        /*width: 250px;*/

        /*overflow-x: hidden;*/
        overflow-y: auto;

        max-width: 350px;

    }

    .flex-content {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;

        width: 70%;

        overflow-y: auto;
        overflow-x: auto;
        padding: 15px;
    }


    .flex-menu h4 {
        font-size: 20px;
        color: #919191;
        margin: 15px 15px 5px 15px;
    }

    .item-tree a:focus {
        color: #fb7217;
        text-decoration: none;
    }

    .item-tree li {
        display: block;
        padding-top: 8px;
    }

    .item-tree ul {
        padding-left: 0px;
    }

    .item-tree ul li {
        padding-left: 15px;
    }

    .toggle-expand {
        width: 18px;
        min-height: 10px;
        color: #b7b7b7;
        text-align: center;
        font-size: 18px;
        margin-top: -4px;
    }

    .active-menu {
        font-weight: 700;
    }


    /*
     * 
     * Content Navbar
     *
     */

    .content-navbar {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: flex-start;
        -ms-flex-pack: start;
        justify-content: flex-start;
        -webkit-align-content: stretch;
        -ms-flex-line-pack: stretch;
        align-content: stretch;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;

        max-width: 1120px;
        margin: 15px 0px 15px 0px;
    }

    .content-navbar-back {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 20px;
    }

    .content-navbar-bread {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 1 1 auto;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        padding-left: 15px;
    }

    .content-navbar-next {
        -webkit-order: 0;
        -ms-flex-order: 0;
        order: 0;
        -webkit-flex: 0 1 auto;
        -ms-flex: 0 1 auto;
        flex: 0 1 auto;
        -webkit-align-self: stretch;
        -ms-flex-item-align: stretch;
        align-self: stretch;
        width: 20px;
    }

    .bread-seperator {
        color: #b7b7b7;
    }

    .arrow-btn {
        display: none;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }


    .tools {
        margin: -15px 0 0 0;
        background: #FFF;
        border-width: 0px 0px 1px 0px;
        border-color: #d3d3d3;
        border-style: solid;
        padding: 5px;
    }

    .tools .sp {
        height: 18px;
        border-width: 0px 1px 0px 0px;
        border-color: #d3d3d3;
        border-style: solid;
        width: 15px;
        margin-right: 15px;
        display: inline-block;
    }

    .tools .btn {
        border-radius: 0;
        border: none;
        color: #fb7217;

    }
    .in-active{
        //pointer-events: none;
        cursor: default;
        color: #636B6F;
    }

    .tip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .menu-btn-disabled {
        color: #b2b2b2;
    }

    .menu-btn-disabled:hover {
        color: #b2b2b2;
        cursor: not-allowed;
    }

    .menu-btn-disabled:focus {
        color: #b2b2b2;
        outline: none;
    }

    .menu-btn-disabled {
        color: #b2b2b2 !important;
    }

    .menu-btn-disabled:hover {
        color: #b2b2b2;
        cursor: not-allowed;
    }

    .menu-btn-disabled:focus {
        color: #b2b2b2;
        outline: none;
    }

    .tree-collapse-button {
        width: 25px;
        height: 25px;
        margin: -15px 0 0 -15px;
        background: #e2e2e2;
        float: left;
        text-align: center;
    }

</style>
<div class="container">
<div class="row">    
<ul style="list-style-type:none">    
@each('exports::module.items', $items, 'item','eon.storyline2::student.partials.none')
</ul>
</div>
</div>    
<footer class="row">
   
</footer> 
</body>
</html>
