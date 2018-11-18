@extends('layouts.master')

@section('content')

<?php use App\Post; use App\Http\Controllers\PostController;?>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#btn-play").click(function(){
          audio = document.getElementById("audio");
          if($(this).attr("data-state") == "stopped") {
            audio.load();
            audio.play();
            $(this).attr("data-state", "playing");
            $(this).text("Loading...");
          }
          else if($(this).attr("data-state") == "playing") {
            audio.pause();
            $(this).attr("data-state", "stopped");
            $(this).text("Listen");
          }
        });

        audio.onloadeddata = function(){
          if($("#btn-play").attr("data-state") == "playing")
            $("#btn-play").text("Stop");
        };
      });
    </script>

    <div class="container">

      <div class="row">
        <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
          <div class="col-md-6">
            <img src="/images/logo.jpg" style="max-width: 100%;">
          </div>
          <div class="col-md-6">
            <div id="jg-widget-raw1251am-820"></div><script>(function(){var id="jg-widget-raw1251am-820",doc=document,pfx=(window.location.toString().indexOf("https")==0)?"https":"http";var el=doc.getElementById(id);if(el){var js=doc.createElement('script');js.src=pfx+"://widgets.justgiving.com/fundraisingpage/raw1251am?enc=ZT1qZy13aWRnZXQtcmF3MTI1MWFtLTgyMCZ3PTQwMCZiPWlubmVyLGRvbmF0ZSZpYj1wcm9ncmVzcyxyYWlzZWQsdGFyZ2V0";el.parentNode.insertBefore(js, el);}})();</script>

            <br>
            <p>
              <button id="btn-play" type="button" data-state="stopped" class="btn btn-lg btn-success btn-block">Listen</button>
            </p>

            <audio id="audio" style="display:none;" controls>
              <source src="https://streams.radio.warwick.ac.uk/raw-high.mp3" type="audio/mpeg">
            </audio>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
          <div class="[ panel panel-default ] panel-marawthon">
            @if(!is_null(auth()->user()))
              <div class="panel-heading">
                Hello {{ auth()->user()->name}}, welcome to the charity feed.
              </div>            
              <div class="panel-body">
                If you want to post do it <a href="{{route('post')}}">here</a>.
              </div>
              <div class="panel-footer">
                <a href="{{ route('logout')}}">Log out</a>
              </div>
            @else
              <div class="panel-heading">
                <h3><span>Member Login</span></h3>
              </div>
              <div class="panel-body">
                <a href="login">Login</a> to post to the feed.
              </div>
            @endif
          </div>
        </div>
      </div>

<?php
$ctrl = new PostController;
echo $ctrl->getAllPostHTML();
?>


    <div class="row">
      <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
        <div class="[ panel panel-default ] panel-marawthon photo">
          <div class="panel-body">
            <span style="text-align: center; margin-bottom: 8px; display: block; font-size:14pt;">RAW Marathon 2018<hr style="width: 30%; margin-top: 20px; margin-bottom: 20px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640.36249 277.95001" style="max-width: 40%;" version="1.1"><defs id="defs6"><clipPath id="clipPath18" clipPathUnits="userSpaceOnUse"><path id="path20" d="M 0,2223.6 0,0 l 5122.9,0 0,2223.6 -5122.9,0 z"></path></clipPath></defs><g transform="matrix(1.25,0,0,-1.25,0,277.95)" id="g10"><g transform="scale(0.1,0.1)" id="g12"><g id="g14"><g clip-path="url(#clipPath18)" id="g16"><path id="path22" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 1535.61,1041.87 468.02,0 c 45.2,0 85.9,9.59 122.09,28.82 36.16,19.21 66.98,44.36 92.41,75.46 25.44,31.08 44.94,66.4 58.51,105.99 13.57,39.55 20.35,80.25 20.35,122.09 0,42.95 -7.93,84.2 -23.74,123.79 -15.85,39.55 -37.6,74.61 -65.29,105.12 -27.71,30.53 -60.2,55.12 -97.5,73.77 -37.31,18.65 -76.89,27.98 -118.7,27.98 l -456.15,0 0,-663.02 z m -33.91,-507.018 0,1203.948 490.06,0 c 48.59,0 93.82,-10.46 135.66,-31.37 41.8,-20.93 77.71,-48.61 107.67,-83.09 29.94,-34.5 53.42,-73.49 70.37,-117 16.96,-43.53 25.44,-87.91 25.44,-133.11 0,-46.37 -7.36,-91.02 -22.04,-133.96 -14.71,-42.98 -35.61,-81.13 -62.75,-114.46 -27.13,-33.37 -59.64,-60.5 -97.5,-81.39 -37.89,-20.94 -79.43,-33.07 -124.63,-36.47 l 305.22,-473.098 -40.69,0 -305.23,473.098 -447.67,0 0,-473.098 -33.91,0"></path><path id="path24" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 3002.42,1738.8 30.53,0 523.97,-1203.948 -37.3,0 -502.78,1161.948 -314.55,-731.241 -188.23,-430.707 -37.3,0 525.66,1203.948"></path><path id="path26" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 5122.9,1726.93 -377.29,-1192.078 -41.55,0 -378.14,1100.518 c -3.97,11.3 -7.07,22.59 -9.33,33.91 -2.26,-11.32 -5.38,-22.61 -9.32,-33.91 l -379.85,-1100.518 -40.69,0 -377.3,1192.078 38.16,0 c 9.6,0 15.82,-4.8 18.65,-14.41 L 3895.21,653.559 c 5.64,-19.239 10.45,-39.571 14.41,-61.059 2.26,11.309 4.67,22.051 7.21,32.23 2.55,10.168 5.22,19.758 8.05,28.829 L 4292,1712.52 c 2.82,9.61 9.61,14.41 20.35,14.41 l 11.02,0 c 9.61,0 15.82,-4.8 18.66,-14.41 L 4709.15,653.559 c 5.64,-17.539 10.73,-37.598 15.26,-60.2 2.25,11.289 4.52,21.903 6.78,31.782 2.26,9.879 4.8,19.347 7.63,28.418 l 328.97,1058.961 c 2.83,9.61 9.6,14.41 20.34,14.41 l 34.77,0"></path><g><path id="path28" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 1220.91,259.398 c 0,-9.359 -7.59,-16.957 -16.95,-16.957 l 0,0 c -9.37,0 -16.96,7.598 -16.96,16.957 l 0,1711.782 c 0,9.36 7.59,23.5 16.96,23.5 l 0,0 c 9.36,0 16.95,-14.14 16.95,-23.5 l 0,-1711.782"></path><path id="path30" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 746.113,323.281 c 0,-8.75 -7.593,-15.84 -16.957,-15.84 l 0,0 c -9.367,0 -16.961,7.09 -16.961,15.84 l 0,1598.139 c 0,8.76 7.594,22.38 16.961,22.38 l 0,0 c 9.364,0 16.957,-13.62 16.957,-22.38 l 0,-1598.139"></path><path id="path32" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 508.715,683.34 c 0,-4.219 -7.598,-16.969 -16.957,-16.969 l 0,0 c -9.371,0 -16.957,12.75 -16.957,16.969 l 0,754.57 c 0,4.2 7.586,14.14 16.957,14.14 l 0,0 c 9.359,0 16.957,-9.94 16.957,-14.14 l 0,-754.57"></path><path id="path34" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 33.9141,683.34 c 0,-4.219 -7.5938,-16.969 -16.9571,-16.969 l 0,0 C 7.58594,666.371 0,679.121 0,683.34 l 0,754.57 c 0,4.2 7.58594,14.14 16.957,14.14 l 0,0 c 9.3633,0 16.9571,-9.94 16.9571,-14.14 l 0,-754.57"></path><path id="path36" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="m 271.313,828.852 c 0,-2.661 -7.59,-16.93 -16.958,-16.93 l 0,0 c -9.359,0 -16.953,14.269 -16.953,16.93 l 0,468.468 c 0,2.68 7.594,14.84 16.953,14.84 l 0,0 c 9.368,0 16.958,-12.16 16.958,-14.84 l 0,-468.468"></path><path id="path38" style="fill:#ceac21;fill-opacity:1;fill-rule:nonzero;stroke:none;" d="M 983.516,21.5195 C 983.516,9.62891 975.918,0 966.559,0 l 0,0 c -9.371,0 -16.957,9.62891 -16.957,21.5195 l 0,2180.5605 c 0,11.88 7.586,21.52 16.957,21.52 l 0,0 c 9.359,0 16.957,-9.64 16.957,-21.52 l 0,-2180.5605"></path></g></g></g></g></g></svg></span>
          </div>
        </div>
      </div>
    </div> 
</div>

@endsection