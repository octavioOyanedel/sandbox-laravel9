<div>
    <div>
         <select id="select-beast2" placeholder="Select a person..." autocomplete="off">
             <option value="">Select a person...</option>
             @if($provincias)
                 @foreach($provincias as $provincia)
                     <option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
                 @endforeach
             @endif
         </select>       
    </div>
</div>