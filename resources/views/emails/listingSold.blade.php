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
		<p>Congrats your post, {{$offer->post()->first()->title}} sold!</p>
		<br>
		 <p>The accepted offer was: "{{$offer->content}}"</p>

		 <P>The buyer has your email and should be in contact within a day to arrange a meeting.</P>

		 <p>Once the transaction is complete please <a href="{{ URL::to('feedback/'.$feedback->id) }}">leave feedback</a> for the buyer!</p>

		 <P>The sellers email is: {{$poster->email}}.</P>
		 <br><br>
		 <a href="{{ URL::to('/'.$offer->post()->first()->category_id.'/post/'.$offer->post_id) }}" class="btn btn-primary">View Post</a>
	</div>
    </body>
</html>