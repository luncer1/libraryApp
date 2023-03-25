@if(session()->has('message'))
    <div x-data="{show:true}" x-init="setTimeout(()=>show=false,5000)"  x-show="show" class="flash-message">
        <i class="fa-sharp fa-solid fa-square-check"></i>
        <p> {{ session('message') }}</p>
    </div>
@endif