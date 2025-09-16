@if ($getRecord() && $getRecord()->photo_path)
    <a href="{{ $getRecord()->photo_path }}"
       target="_blank"
       onclick="event.preventDefault(); openImageModal('{{ $getRecord()->photo_path }}')">
        <img src="{{ $getRecord()->photo_path }}"
             alt="Foto da manutenção"
             style="max-height:200px; border-radius:8px; cursor:pointer;">
    </a>
@else
    <span>Sem foto cadastrada</span>
@endif

<!-- Modal -->
<div id="imageModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">
    <img id="modalImage" src="" style="max-height:90%; max-width:90%; border-radius:8px;">
</div>

<script>
    function openImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').style.display = 'flex';
    }
    document.getElementById('imageModal')?.addEventListener('click', function () {
        this.style.display = 'none';
    });
</script>
