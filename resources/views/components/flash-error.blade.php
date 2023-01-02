@if(session()->has('message-err'))
    <div x-data="{show:true}" x-init="setTimeout(()=>show=false,5000)" x-show="show"  class="flash-message flash-error">
        <i class="fa-sharp fa-solid fa-square-xmark"></i>
        <p> {{ session('message-err') }}</p>
    </div>
@endif