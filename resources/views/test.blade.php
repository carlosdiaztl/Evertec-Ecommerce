<h1>
    test
    {{-- {{$text}} --}}
    @php
        
    @endphp
    @foreach ($count_letters as $count => $letter){
      {{$count}}-  {{$letter}}
    }
    
    @endforeach
    <br>
    <br>
    {{$result}}
</h1>