<div class="bluebox">
    <h1>&nbsp;{{$message}}</h1>
    {{$exception->getMessage()}}<br />
    <br />
    {{$exception->getFile()}} : {{$exception->getLine()}}<br />
    <br />
    {{$exception->getTraceAsString()|nl2br}}
</div>
