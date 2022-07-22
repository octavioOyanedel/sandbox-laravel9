<div>
    <div wire:ignore>
         <select id="select-beast" placeholder="Select a person..." autocomplete="off">
             <option value="">Select a person...</option>
             @foreach($distritos as $distrito)
                 <option value="{{$distrito->id}}">{{$distrito->nombre}}</option>
             @endforeach
         </select>       
    </div>
</div>
