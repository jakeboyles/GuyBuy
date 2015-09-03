<html>
    <head>
        <style>

        .header {
        	background-color:#000;
        	padding:20px;
        	margin-bottom:30px;
        }

        .header img {
        		max-width:40%;
        		width:150px;
        		margin:0px auto;
        		display:block;
        		padding:20px;
        }

        p {
        	font-size:17px;
        	line-height:1.5em;
        }
        </style>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>
    <body>

    <div class="header">
    	<a class="logo" href="/"><img src="{{ asset('images/logo.png') }}"></a>
    </div>

	<div>
		<p>Your offer has been denied for {{$offer->post()->first()->title}}!</p>
		<br>
		 <p>Your offer was: "{{$offer->content}}"</p>

         <p>You can submit another offer if you wish by visiting the post and submitting another offer.</p>

		 <br>
		 <a href="{{ URL::to('/'.$offer->post()->first()->category_id.'/post/'.$offer->post_id) }}" class="btn btn-primary">View Post</a>
	</div>
    </body>
</html>