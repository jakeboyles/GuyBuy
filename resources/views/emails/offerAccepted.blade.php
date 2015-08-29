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
		<p>Congrats your offer has been accepted for {{$offer->post()->first()->title}}!</p>
		<br>
		 <p>Your offer was: "{{$offer->content}}"</p>

		 <P>You can now contact the poster of the item and find a good time, and place to meet and get your item!</P>

		 <P>The sellers email is: {{$poster->email}}.</P>

         <p>Once the transaction is complete please <a href="{{ URL::to('feedback/'.$feedback->id) }}">leave feedback</a> for the seller!</p>

		 <br><br>
		 <a href="{{ URL::to('/'.$offer->post()->first()->category_id.'/post/'.$offer->post_id) }}" class="btn btn-primary">View Post</a>
	</div>
    </body>
</html>