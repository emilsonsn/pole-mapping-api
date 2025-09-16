@if ($getRecord() && $getRecord()->photo_path)
    <img src="{{  $getRecord()->photo_path }}"
         alt="Foto da manutenção"
         style="max-height:200px; border-radius:8px;">
@else
    <span>Sem foto cadastrada</span>
@endif
