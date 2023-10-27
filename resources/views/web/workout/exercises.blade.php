@php
    $counter = 1;
@endphp

@foreach($workouts as $workout)
<div class="col-10 m-auto border-bottom">
    <div class="row m-auto text-warning font-20 py-3 text-center">
        <div class="col-2 px-0"><span class="material-symbols-outlined">comment</span></div>
        <div class="col-2 px-0"><b>{{ $counter ++ }} </b></div>
        <div class="col-4 px-2 text-end">{{ $workout->weight }}<span class="text-warning-emphasis font-12"> kgs</span></div>
        <div class="col-4 text-end">{{ $workout->reps }} <span class="text-warning-emphasis font-12"> reps</span></div>
    </div>
</div>
@endforeach

