<div>
   <H1>This This Header Component</H1>
   <h2>Hello {{$name}}</h2>
   <h3>All fruits are: </h3>
   <ul>
      @foreach($fruits as $fruit)
         <li>{{$fruit}}</li>
      @endforeach
   </ul>
</div>