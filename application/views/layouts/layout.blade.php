<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>AAC 2013</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('laravel/css/style.css') }}
</head>
<body>
<div class="wrapper">
    <header>
        <h1>AAC API FRONTEND</h1>
        <h2>Just a REST API Handler</h2>
        <p class="intro-text" style="margin-top: 45px;"></p>
    </header>
    <div role="main" class="main">
    <!--  Yield Section -->
        @yield('main-content')
    </div>
    <footer>
        <p>Copyright &copy; {{ date('Y') }} -  All Rights Reserved - AAC Team</p>
    </footer>
</div>

{{ HTML::script('laravel/js/jquery-1.8.3-min.js') }}
<script>
    $(document).ready(function(){
        var state = $('select#state');
        var auto_change = $('span#auto_select');
        state.change(function(){
            var state_id = state.val();

            // Make Ajax Call
            $.ajax({
                url: "http://aacdev.local/home/lga_list/" + state_id,
                type: "post",
                success: function(html_data){
                    auto_change.html(html_data.html_select);
                    //alert(html_data.html_select);
                },
                error: function(){
                    alert('Invalid state selection!');
                }
            });
        });
    });
</script>
</body>
</html>

