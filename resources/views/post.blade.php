<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
 <h1>Add Post</h1>


 <div class="container">
 <div class="card card-outline-secondary mt-5">
              <div class="card-header">
                <h3 class="mb-0">Add Post</h3>
              </div>
              <div class="card-body">
              <form class="form" id="formLogin" name="formLogin" role="form" method="POST" action ="{{route('post.submit')}}">
                    @csrf
                <div class="form-group">
                    <label for="title">Title</label>
				<input class="form-control" id="title" name="title" type="text">
                  </div>
                  <div class="form-group">
                    <label for="password">Description</label>

                    <textarea name="description"  cols="30" rows="10" class="form-control" id="description"></textarea>
                  </div>
					<input class="btn btn-success mt-3" type="submit" name="post" value="Submit">
                </form>
              </div><!--/card-block-->
            </div><!-- /form card login -->
          </div>
        </div>
 </div>



<h1>All Post  Data</h1>

@foreach ($posts as $post )
<h1>{{$post->title}}</h1>
    <p>{{$post->description}}</p>
@endforeach
</body>
</html>